<?php

namespace App\Service;

use App\Service\Utility\Equivalent;


class EquivalentService
{
    private $equivalent;

    public function __construct(Equivalent $equivalent)
    {

        $this->equivalent = $equivalent;
        
    }

    public function getEquivalent()
    {
        return $this->equivalent;
    }

   

    // public function getEquivalent($points)
    // {
    //     foreach ($this->equivalents as $equivalent) {
    //         if ($points >= $equivalent['min_points'] && $points < $equivalent['max_points']) {
    //             return $equivalent['name'];
    //         }
    //     }
    // }
    



    
}