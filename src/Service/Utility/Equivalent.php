<?php

namespace App\Service\Utility;

class Equivalent
{
    public static function getEquivalent($score)
    {
        $equivalents = [
            [
                "name" => "2 - 3 réfrigérateurs",
                "min_points" => 200,
                "max_points" => 300
            ],
            [
                "name" => "5 - 8 kangourous",
                "min_points" => 300,
                "max_points" => 400
            ],
            [
                "name" => "2 - 3 lions",
                "min_points" => 400,
                "max_points" => 500
            ],
            [
                "name" => "3 - 4 motos",
                "min_points" => 500,
                "max_points" => 750
            ],
            [
                "name" => "2 ours bruns",
                "min_points" => 750,
                "max_points" => 1000
            ],
            [
                "name" => "3 - 4 chevaux",
                "min_points" => 1000,
                "max_points" => 1500
            ],
            [
                "name" => "1 - 2 petites voitures",
                "min_points" => 1500,
                "max_points" => 3000
            ],
            [
                "name" => "1 - 2 camions",
                "min_points" => 3000,
                "max_points" => 6000
            ],
            [
                "name" => "1 - 2 éléphants",
                "min_points" => 6000,
                "max_points" => 10000
            ],
            [
                "name" => "1 yacht",
                "min_points" => 10000,
                "max_points" => 20000
            ],
            [
                "name" => "2 - 3 jets privés",
                "min_points" => 20000,
                "max_points" => 50000
            ],
            [
                "name" => "1 petite maison",
                "min_points" => 50000,
                "max_points" => 100000
            ],
            [
                "name" => "1 - 2 grands camions",
                "min_points" => 100000,
                "max_points" => 200000
            ],
            [
                "name" => "1 train de marchandises",
                "min_points" => 200000,
                "max_points" => 300000
            ],
            [
                "name" => "1 - 2 paquebots",
                "min_points" => 300000,
                "max_points" => 400000
            ],
            [
                "name" => "1 gratte-ciel",
                "min_points" => 400000,
                "max_points" => 500000
            ],
            [
                "name" => "1 porte-avions",
                "min_points" => 500000,
                "max_points" => 600000
            ],
            [
                "name" => "1 station spatiale",
                "min_points" => 600000,
                "max_points" => 700000
            ],
            [
                "name" => "1 pyramide égyptienne",
                "min_points" => 700000,
                "max_points" => 800000
            ],
            [
                "name" => "1 centrale nucléaire",
                "min_points" => 800000,
                "max_points" => 900000
            ],
            [
                "name" => "1 île artificielle",
                "min_points" => 900000,
                "max_points" => 1000000
            ]
        ];

        foreach ($equivalents as $equivalent) {
            if ($score >= $equivalent['min_points'] && $score < $equivalent['max_points']) {
                return $equivalent['name'];
            }
        }

        return "No equivalent found";
    }

    public function __tostring()
    {
        return $this->getEquivalent();
    }
}


