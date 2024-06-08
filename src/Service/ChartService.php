<?php

namespace App\Service;

use App\Repository\TrackingRepository;
use App\Repository\PerformanceRepository;
use Symfony\UX\Chartjs\Builder\ChartBuilderInterface;
use Symfony\Component\String\Slugger\SluggerInterface;

use Symfony\UX\Chartjs\Model\Chart;

class ChartService
{
    private $trackingRepository;
    private $performanceRepository;
    private $chartBuilder;

    public function __construct(
        TrackingRepository $trackingRepository,
        PerformanceRepository $performanceRepository,
        ChartBuilderInterface $chartBuilder
    ) {
        $this->trackingRepository = $trackingRepository;
        $this->performanceRepository = $performanceRepository;
        $this->chartBuilder = $chartBuilder;
    }

    public function getTrackingChart(): Chart
    {
        $trackings = $this->trackingRepository->findAll();

        $trackingLabels = array_map(fn($tracking) => $tracking->getDateOfTracking(), $trackings);
        $trackingHeights = array_map(fn($tracking) => $tracking->getHeight(), $trackings);
        $trackingWeights = array_map(fn($tracking) => $tracking->getWeight(), $trackings);
        $trackingAges = array_map(fn($tracking) => $tracking->getAge(), $trackings);

        $chart = $this->chartBuilder->createChart(Chart::TYPE_LINE);
        $chart->setData([
            'labels' => $trackingLabels,
            'datasets' => [
                [
                    'label' => 'Height',
                    'backgroundColor' => 'rgba(75, 192, 192, 0.2)',
                    'borderColor' => 'rgba(75, 192, 192, 1)',
                    'data' => $trackingHeights,
                ],
                [
                    'label' => 'Weight',
                    'backgroundColor' => 'rgba(153, 102, 255, 0.2)',
                    'borderColor' => 'rgba(153, 102, 255, 1)',
                    'data' => $trackingWeights,
                ],
                [
                    'label' => 'Age',
                    'backgroundColor' => 'rgba(255, 159, 64, 0.2)',
                    'borderColor' => 'rgba(255, 159, 64, 1)',
                    'data' => $trackingAges,
                ],
            ],
        ]);

        return $chart;
    }

    public function getPerformanceChart(): Chart
    {
        $performances = $this->performanceRepository->findAll();

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

        $chart = $this->chartBuilder->createChart(Chart::TYPE_BAR);
        $chart->setData([
            'labels' => $performanceLabels,
            'datasets' => array_values($datasets), // Réinitialisez les clés d'index pour les datasets
        ]);

        return $chart;
    }

    private function generateRandomColor(): string
    {
        // Générer une couleur aléatoire au format hexadécimal
        return '#' . substr(md5(mt_rand()), 0, 6);
    }
}
