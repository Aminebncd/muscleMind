<?php

namespace App\Service;

use Symfony\UX\Chartjs\Model\Chart;
use Symfony\UX\Chartjs\Builder\ChartBuilderInterface;
use App\Entity\User;

class ChartService
{
    private $chartBuilder;

    public function __construct(ChartBuilderInterface $chartBuilder)
    {
        $this->chartBuilder = $chartBuilder;
    }

    public function generateTestChart(): Chart
    {
        $labels = ['January', 'February', 'March', 'April', 'May', 'June', 'July'];
        $data = [65, 59, 80, 81, 56, 55, 40];

        $chart = $this->chartBuilder->createChart(Chart::TYPE_LINE);
        $chart->setData([
            
            'labels' => $labels,
            'datasets' => [
                [
                    'label' => 'tracking example',
                    'backgroundColor' => 'rgba(75, 192, 192, 0.2)',
                    'borderColor' => 'rgba(75, 192, 192, 1)',
                    'data' => $data,
                ],
            ],
            
        ]);
        $chart->setOptions([
            'plugins' => [
                'zoom' => [
                    'zoom' => [
                        'wheel' => ['enabled' => true],
                        'pinch' => ['enabled' => true],
                        'mode' => 'xy',
                    ],
                ],
            ],
        ]);

        return $chart;
    }

    public function getTrackingChart(User $user = null): Chart
{
    if ($user === null) {
        throw new \InvalidArgumentException('User cannot be null');
    }

    if ($user->getTrackings()->isEmpty()) {
        return $this->generateTestChart();
    }

    $trackings = $user->getTrackings()->toArray();

    // tbh there's no need to track your height, age, etc. in a fitness app
    // the weight is enough
    $trackingLabels = array_map(fn($tracking) => $tracking->getDateOfTracking(), $trackings);
    $trackingWeights = array_map(fn($tracking) => $tracking->getWeight(), $trackings);

    $chart = $this->chartBuilder->createChart(Chart::TYPE_LINE);
    $chart->setData([
        'labels' => $trackingLabels,
        'datasets' => [
            [
                'label' => 'Weight',
                'backgroundColor' => 'rgba(153, 102, 255, 0.2)',
                'borderColor' => 'rgba(153, 102, 255, 1)',
                'data' => $trackingWeights,
            ],
        ],
    ]);
    $chart->setOptions([
        'scales' => [
            'x' => [
                'grid' => [
                    'color' => 'rgba(100, 100, 100, 0.1)', 
                ],
                'ticks' => [
                    'color' => 'rgba(255, 255, 255, 0.5)', 
                ],
            ],
            'y' => [
                'suggestedMin' => (min($trackingWeights) - 10),
                'suggestedMax' => (max($trackingWeights) + 10),
                'grid' => [
                    'color' => 'rgba(100, 100, 100, 0.3)', 
                ],
                'ticks' => [
                    'color' => 'rgba(255, 255, 255, 0.5)', 
                ],
            ],
        ],
        'plugins' => [
            'zoom' => [
                'zoom' => [
                    'wheel' => ['enabled' => true],
                    'pinch' => ['enabled' => true],
                    'mode' => 'xy',
                ],
            ],
        ],
    ]);

    return $chart;
}


    public function getPerformanceChart(User $user = null): Chart
    {
        if ($user === null) {
            throw new \InvalidArgumentException('User cannot be null');
        }

        if ($user->getPerformances()->isEmpty()) {
            return $this->generateTestChart();
        }
    

        $performances = $user->getPerformances()->toArray();

        $performanceLabels = array_map(fn($performance) => $performance->getDateOfPerformance(), $performances);
        $performanceRecords = array_map(fn($performance) => $performance->getPersonnalRecord(), $performances);
        $performanceExercises = array_map(fn($performance) => $performance->getExerciceMesured()->getExerciceName(), $performances);

        $datasets = [];
        $exerciseColors = [];

        foreach ($performanceExercises as $exercise) {
            if (!isset($exerciseColors[$exercise])) {
                $exerciseColors[$exercise] = $this->generateRandomColor();
            }
        }

        foreach ($performanceExercises as $index => $exercise) {
            $datasets[$exercise]['label'] = $exercise;
            $datasets[$exercise]['backgroundColor'] = $exerciseColors[$exercise];
            $datasets[$exercise]['borderColor'] = $exerciseColors[$exercise];
            $datasets[$exercise]['data'][] = $performanceRecords[$index];
        }

        $chart = $this->chartBuilder->createChart(Chart::TYPE_LINE);
        $chart->setData([
            'labels' => $performanceLabels,
            'datasets' => array_values($datasets),
        ]);

        $chart->setOptions([
            'scales' => [
                'x' => [
                    'grid' => [
                        'color' => 'rgba(100, 100, 100, 0.1)', 
                    ],
                    'ticks' => [
                        'color' => 'rgba(255, 255, 255, 0.5)', 
                    ],
                ],
                'y' => [
                    'suggestedMin' => (min($performanceRecords) - 20),
                    'suggestedMax' => (max($performanceRecords) + 30),
                    'grid' => [
                        'color' => 'rgba(100, 100, 100, 0.3)', 
                    ],
                    'ticks' => [
                        'color' => 'rgba(255, 255, 255, 0.5)', 
                    ],
                ],
            ],
            'plugins' => [
                'zoom' => [
                    'zoom' => [
                        'wheel' => ['enabled' => true],
                        'pinch' => ['enabled' => true],
                        'mode' => 'xy',
                    ],
                ],
            ],
        ]);

        return $chart;
    }

    public function getWeeklyMuscleHeatmap(User $user = null): Chart
    {
        if ($user === null) {
            throw new \InvalidArgumentException('User cannot be null');
        }

        $now = new \DateTime();
        $start = (clone $now)->modify('-6 days');

        $days = ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'];
        $heatmap = [];
        $muscleNames = [];

        foreach ($user->getSessions() as $session) {
            $date = $session->getDateSession();
            if ($date < $start || $date > $now) {
                continue;
            }

            $dayIndex = ((int) $date->format('N')) - 1;
            $program = $session->getProgram();
            $primary = $program->getMuscleGroupTargeted()->getName();
            $secondaryGroup = $program->getSecondaryMuscleGroupTargeted();

            foreach ([$primary, $secondaryGroup?->getName()] as $muscle) {
                if (!$muscle) {
                    continue;
                }
                $muscleNames[$muscle] = true;
                $heatmap[$muscle][$dayIndex] = ($heatmap[$muscle][$dayIndex] ?? 0) + 1;
            }
        }

        $muscles = array_keys($muscleNames);
        sort($muscles);

        // Create scatter plot data instead of matrix
        $scatterData = [];
        $max = 0;
        foreach ($muscles as $y => $muscle) {
            for ($x = 0; $x < 7; $x++) {
                $value = $heatmap[$muscle][$x] ?? 0;
                if ($value > 0) {
                    $scatterData[] = [
                        'x' => $x,
                        'y' => $y,
                        'r' => $value * 10 + 5, // radius based on value
                    ];
                }
                $max = max($max, $value);
            }
        }

        // If no data, return a simple message chart
        if (empty($scatterData)) {
            $chart = $this->chartBuilder->createChart(Chart::TYPE_DOUGHNUT);
            $chart->setData([
                'labels' => ['No training sessions in the last 7 days'],
                'datasets' => [[
                    'data' => [1],
                    'backgroundColor' => ['rgba(200,200,200,0.3)'],
                    'borderColor' => ['rgba(200,200,200,0.5)'],
                ]],
            ]);
            $chart->setOptions([
                'responsive' => true,
                'plugins' => [
                    'legend' => ['display' => true],
                ],
            ]);
            return $chart;
        }

        $chart = $this->chartBuilder->createChart(Chart::TYPE_BUBBLE);
        $chart->setData([
            'datasets' => [[
                'label' => 'Training sessions per muscle group',
                'data' => $scatterData,
                'backgroundColor' => 'rgba(255,99,132,0.7)',
                'borderColor' => 'rgba(255,99,132,1)',
                'borderWidth' => 2,
            ]],
        ]);

        $chart->setOptions([
            'responsive' => true,
            'maintainAspectRatio' => false,
            'scales' => [
                'x' => [
                    'type' => 'linear',
                    'position' => 'bottom',
                    'min' => -0.5,
                    'max' => 6.5,
                    'title' => [
                        'display' => true,
                        'text' => 'Days of the Week',
                        'color' => 'rgba(255, 255, 255, 0.8)',
                        'font' => [
                            'size' => 14,
                            'weight' => 'bold',
                        ],
                    ],
                    'ticks' => [
                        'stepSize' => 1,
                        'color' => 'rgba(255, 255, 255, 0.7)',
                        'callback' => 'function(value) { 
                            const days = ["Mon", "Tue", "Wed", "Thu", "Fri", "Sat", "Sun"];
                            return days[Math.round(value)] || ""; 
                        }',
                    ],
                    'grid' => [
                        'color' => 'rgba(100, 100, 100, 0.3)',
                    ],
                ],
                'y' => [
                    'type' => 'linear',
                    'min' => -0.5,
                    'max' => count($muscles) - 0.5,
                    'title' => [
                        'display' => true,
                        'text' => 'Muscle Groups',
                        'color' => 'rgba(255, 255, 255, 0.8)',
                        'font' => [
                            'size' => 14,
                            'weight' => 'bold',
                        ],
                    ],
                    'ticks' => [
                        'stepSize' => 1,
                        'color' => 'rgba(255, 255, 255, 0.7)',
                        'callback' => 'function(value) { 
                            const muscles = ' . json_encode($muscles) . ';
                            return muscles[Math.round(value)] || ""; 
                        }',
                    ],
                    'grid' => [
                        'color' => 'rgba(100, 100, 100, 0.3)',
                    ],
                ],
            ],
            'plugins' => [
                'title' => [
                    'display' => true,
                    'text' => 'Weekly Muscle Training Heatmap (Last 7 Days)',
                    'color' => 'rgba(255, 255, 255, 0.9)',
                    'font' => [
                        'size' => 16,
                        'weight' => 'bold',
                    ],
                    'padding' => 20,
                ],
                'legend' => [
                    'display' => true,
                    'labels' => [
                        'color' => 'rgba(255, 255, 255, 0.8)',
                        'usePointStyle' => true,
                        'generateLabels' => 'function(chart) {
                            return [{
                                text: "Bubble size = number of sessions",
                                fillStyle: "rgba(255,99,132,0.7)",
                                strokeStyle: "rgba(255,99,132,1)",
                                pointStyle: "circle"
                            }];
                        }',
                    ],
                ],
                'tooltip' => [
                    'backgroundColor' => 'rgba(0, 0, 0, 0.8)',
                    'titleColor' => 'rgba(255, 255, 255, 1)',
                    'bodyColor' => 'rgba(255, 255, 255, 0.9)',
                    'borderColor' => 'rgba(255, 99, 132, 1)',
                    'borderWidth' => 1,
                    'callbacks' => [
                        'title' => 'function(context) { 
                            const days = ["Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday", "Sunday"];
                            const muscles = ' . json_encode($muscles) . ';
                            const point = context[0];
                            return days[Math.round(point.parsed.x)] + " - " + muscles[Math.round(point.parsed.y)];
                        }',
                        'label' => 'function(context) { 
                            const sessions = Math.round((context.parsed.r - 5) / 10);
                            return "Training sessions: " + sessions; 
                        }',
                        'afterLabel' => 'function(context) {
                            return "Larger bubble = more sessions";
                        }',
                    ],
                ],
            ],
        ]);

        return $chart;
    }

    private function generateRandomColor(): string
    {
        // generate a random color
        return '#' . substr(md5(mt_rand()), 0, 6);
    }
}
