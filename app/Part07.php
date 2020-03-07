<?php
namespace App;

use MathPHP\Algebra;

class Part07 extends Part
{
    private $colors = [
        'cyan' => '3846',
        'blueGrey' => '932',
        'slateBlue' => '930',
        'navy' => '336',
    ];

    private $colorMap = []; // Start with an empty color map. We'll fill it in later

    // The pattern. Each number represents a coresponding function to check the number against
    // 0: Empty
    // 1: The product of the first two digits equals the product of the last two digits
    // 2: A Deficient Number
    // 3: The sum of the digits is greater than the product of the digits
    // 4: A Harshad Number
    private $pattern = [
        [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0],
        [0, 0, 0, 0, 0, 1, 0, 0, 0, 0, 0],
        [0, 0, 0, 0, 1, 1, 2, 0, 0, 0, 0],
        [0, 0, 0, 1, 1, 1, 2, 2, 0, 0, 0],
        [0, 0, 1, 1, 1, 1, 2, 2, 2, 0, 0],
        [0, 1, 1, 1, 1, 1, 1, 2, 2, 2, 0],
        [0, 0, 3, 3, 3, 3, 3, 4, 4, 0, 0],
        [0, 0, 0, 3, 3, 3, 3, 4, 0, 0, 0],
        [0, 0, 0, 0, 3, 3, 4, 0, 0, 0, 0],
        [0, 0, 0, 0, 0, 3, 0, 0, 0, 0, 0],
        [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0],
    ];

    public function __construct()
    {
        $this->setOffset(new Point(38, 14));

        // Build a color map of which functions map to which color
        foreach ($this->colors as $colorName => $number) {
            if ($this->productsMatch($number)) {
                $this->colorMap[1] = $colorName;
                $this->useColor($colorName, $number);
            } elseif ($this->isDeficient($number)) {
                $this->colorMap[2] = $colorName;
                $this->useColor($colorName, $number);
            } elseif ($this->sumGreaterThanProduct($number)) {
                $this->colorMap[3] = $colorName;
                $this->useColor($colorName, $number);
            } elseif ($this->isHarshad($number)) {
                $this->colorMap[4] = $colorName;
                $this->useColor($colorName, $number);
            }
        }
    }

    private function productsMatch($number)
    {
        $firstTwoDigits = substr($number, 0, 2);
        $lastTwoDigits = substr($number, -2, 2);
        $productA = $firstTwoDigits[0] * $firstTwoDigits[1];
        $productB = $lastTwoDigits[0] * $lastTwoDigits[1];
        return $productA == $productB;
    }

    private function isDeficient($number)
    {
        // A number is deficient if all of its factors (except itself) together
        // add up to less than the number. Ex.: the factors of 8 are 8, 4, 2,
        // and 1. 4+2+1=7, which is smaller than 8.

        $factors = Algebra::factors($number); // Get all the factors for this number
        $factors = array_diff($factors, [$number]); // Remove the number itself
        $sumOfFactors = array_sum($factors);
        return ($sumOfFactors < $number);
    }

    private function sumGreaterThanProduct($number)
    {
        $digits = str_split($number);
        return array_sum($digits) > array_product($digits);
    }

    public function isHarshad($number)
    {
        $digits = str_split($number);
        $sumOfDigits = array_sum($digits);
        return $number % $sumOfDigits == 0; // Evenly divisible with remainder of 0
    }

    public function render()
    {
        foreach ($this->pattern as $y => $row) {
            foreach ($row as $x => $colorId) {
                if (isset($this->colorMap[$colorId])) {
                    $this->setColor($this->colorMap[$colorId])->plot(new Point($x, $y));
                }
            }
        }

        return $this;
    }
}
