<?php

namespace App\Service;

class EquivalentService
{
    public static function getEquivalent($score)
    {
        $equivalents = [
            [
                "name" => "200 - 300 laptops",
                "min_points" => 200,
                "max_points" => 300,
                "image" => "https://www.amazon.fr/s?k=ordinateur+portable+samsung&__mk_fr_FR=%C3%85M%C3%85%C5%BD%C3%95%C3%91"
            ],
            [
                "name" => "70 - 100 cats",
                "min_points" => 300,
                "max_points" => 400,
                "image" => "https://example.com/images/cats.jpg"
            ],
            [
                "name" => "50 - 75 bicycles",
                "min_points" => 400,
                "max_points" => 500,
                "image" => "https://example.com/images/bicycles.jpg"
            ],
            [
                "name" => "80 - 120 large suitcases",
                "min_points" => 500,
                "max_points" => 750,
                "image" => "https://example.com/images/suitcases.jpg"
            ],
            [
                "name" => "2 - 3 grand pianos",
                "min_points" => 750,
                "max_points" => 1000,
                "image" => "https://example.com/images/grand_pianos.jpg"
            ],
            [
                "name" => "3 - 4 horses",
                "min_points" => 1000,
                "max_points" => 1500,
                "image" => "https://example.com/images/horses.jpg"
            ],
            [
                "name" => "5 - 7 kayaks",
                "min_points" => 1500,
                "max_points" => 3000,
                "image" => "https://example.com/images/kayaks.jpg"
            ],
            [
                "name" => "10 - 15 refrigerators",
                "min_points" => 3000,
                "max_points" => 6000,
                "image" => "https://example.com/images/refrigerators.jpg"
            ],
            [
                "name" => "4 - 5 elephants",
                "min_points" => 6000,
                "max_points" => 10000,
                "image" => "https://example.com/images/elephants.jpg"
            ],
            [
                "name" => "1 small yacht",
                "min_points" => 10000,
                "max_points" => 20000,
                "image" => "https://example.com/images/small_yacht.jpg"
            ],
            [
                "name" => "20 - 30 motorcycles",
                "min_points" => 20000,
                "max_points" => 50000,
                "image" => "https://img1.picmix.com/output/stamp/normal/6/5/1/5/1905156_867bd.png"
            ],
            [
                "name" => "1 - 2 small houses",
                "min_points" => 50000,
                "max_points" => 100000,
                "image" => "https://example.com/images/small_houses.jpg"
            ],
            [
                "name" => "3 - 4 large trucks",
                "min_points" => 100000,
                "max_points" => 200000,
                "image" => "https://example.com/images/large_trucks.jpg"
            ],
            [
                "name" => "5 - 6 railcars",
                "min_points" => 200000,
                "max_points" => 300000,
                "image" => "https://example.com/images/railcars.jpg"
            ],
            [
                "name" => "7 - 8 private jets",
                "min_points" => 300000,
                "max_points" => 400000,
                "image" => "https://pngimg.com/uploads/plane/plane_PNG101267.png"
            ],
            [
                "name" => "1 skyscraper",
                "min_points" => 400000,
                "max_points" => 500000,
                "image" => "https://images-wixmp-ed30a86b8c4ca887773594c2.wixmp.com/f/1ebd221d-3581-4775-8f4c-086c377bc4c3/ddut8yz-7ad551df-02ca-41aa-88b8-0a3eb7b65e89.png?token=eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJzdWIiOiJ1cm46YXBwOjdlMGQxODg5ODIyNjQzNzNhNWYwZDQxNWVhMGQyNmUwIiwiaXNzIjoidXJuOmFwcDo3ZTBkMTg4OTgyMjY0MzczYTVmMGQ0MTVlYTBkMjZlMCIsIm9iaiI6W1t7InBhdGgiOiJcL2ZcLzFlYmQyMjFkLTM1ODEtNDc3NS04ZjRjLTA4NmMzNzdiYzRjM1wvZGR1dDh5ei03YWQ1NTFkZi0wMmNhLTQxYWEtODhiOC0wYTNlYjdiNjVlODkucG5nIn1dXSwiYXVkIjpbInVybjpzZXJ2aWNlOmZpbGUuZG93bmxvYWQiXX0.zS1Y4Dd6wJT_TI4q7i9hHrmPAwGfaCR7FNHD7OO2ZRA"
            ],
            [
                "name" => "10 - 15 cruise ships",
                "min_points" => 500000,
                "max_points" => 600000,
                "image" => "https://example.com/images/cruise_ships.jpg"
            ],
            [
                "name" => "20 - 25 space shuttles",
                "min_points" => 600000,
                "max_points" => 700000,
                "image" => "https://example.com/images/space_shuttles.jpg"
            ],
            [
                "name" => "50 - 60 blue whales",
                "min_points" => 700000,
                "max_points" => 800000,
                "image" => "https://example.com/images/blue_whales.jpg"
            ],
            [
                "name" => "100 - 120 passenger airplanes",
                "min_points" => 800000,
                "max_points" => 900000,
                "image" => "https://example.com/images/passenger_airplanes.jpg"
            ],
            [
                "name" => "1 artificial island",
                "min_points" => 900000,
                "max_points" => 1000000,
                "image" => "https://example.com/images/artificial_island.jpg"
            ]
        ];
            

        foreach ($equivalents as $equivalent) {
            if ($score >= $equivalent['min_points'] && $score < $equivalent['max_points']) {
                return ['name' => $equivalent['name'], 'image' => $equivalent['image']];
            }
        }
    }

    public function __tostring()
    {
        return $this->getEquivalent();
    }
}


