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
                'y' => [
                    'suggestedMin' => (min($trackingWeights) - 30),
                    'suggestedMax' => (max($trackingWeights) + 30),
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
                'y' => [
                    'suggestedMin' => (min($performanceRecords) - 20),
                    'suggestedMax' => (max($performanceRecords) + 30),
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
