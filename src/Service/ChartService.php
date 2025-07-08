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

        $matrixData = [];
        $max = 0;
        foreach ($muscles as $y => $muscle) {
            for ($x = 0; $x < 7; $x++) {
                $value = $heatmap[$muscle][$x] ?? 0;
                $matrixData[] = ['x' => $x, 'y' => $y, 'v' => $value];
                $max = max($max, $value);
            }
        }

        $max = $max ?: 1;

        $chart = $this->chartBuilder->createChart('matrix');
        $chart->setData([
            'labels' => $days,
            'datasets' => [[
                'label' => 'Weekly muscle heatmap',
                'data' => $matrixData,
                'backgroundColor' => "ctx => { const v = ctx.dataset.data[ctx.dataIndex].v; const a = v / $max; return `rgba(255,99,132,${a})`; }",
                'width' => 'ctx.chart.chartArea ? (ctx.chart.chartArea.width / 7) - 1 : 0',
                'height' => 'ctx.chart.chartArea ? (ctx.chart.chartArea.height / '.count($muscles).') - 1 : 0',
            ]],
        ]);

        $chart->setOptions([
            'responsive' => true,
            'scales' => [
                'x' => [
                    'type' => 'category',
                    'labels' => $days,
                ],
                'y' => [
                    'type' => 'category',
                    'labels' => $muscles,
                ],
            ],
            'plugins' => [
                'legend' => ['display' => false],
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
