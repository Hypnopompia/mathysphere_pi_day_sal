<?php
namespace App;

use MathPHP\Algebra;

class Part05 extends Part
{
    private $problems;

    private $colors = [
        'cyan' => [2, -2],
        'slateBlue' => [3, -3],
    ];

    public function __construct()
    {
        $this->setOffset(new Point(14, 14));
        $this->useColor('cyan', '3846');
        $this->useColor('slateBlue', '930');

        $this->problems['H1'] = [1, 0, -49]; // x²-49
        $this->problems['I1'] = [1, 2, -48]; // x²+2x-48
        $this->problems['J1'] = [1, -3, -70]; // x²-3x-70
        $this->problems['K1'] = [1, -1, -72]; // x²-1-72

        $this->problems['H2'] = [1, 12, -13]; // x²+12x-13
        $this->problems['I2'] = [1, 9, -10]; // x²+9x-10
        $this->problems['J2'] = [1, 5, 4]; // x²+5x+4
        $this->problems['K2'] = [1, -8, 12]; // x²-8+12

        $this->problems['G3'] = [1, -4, -60]; // x²-4x-60
        $this->problems['H3'] = [1, -21, 108]; // x²-21x+108
        $this->problems['I3'] = [1, -7, 10]; // x²-7x+10
        $this->problems['J3'] = [1, 6, 5]; // x²+6x+5
        $this->problems['K3'] = [1, 2, -35]; // x²+2-35

        $this->problems['F4'] = [1, 4, -45]; // x²+4x-45
        $this->problems['G4'] = [1, 11, -26]; // x²+11x-26
        $this->problems['H4'] = [1, 13, 40]; // x²+13x+40

        $this->problems['E5'] = [1, 2, -35]; // x²+2x-35
        $this->problems['F5'] = [1, 2, 1]; // x²+2x+1
        $this->problems['G5'] = [1, 9, 8]; // x²+9x+8

        $this->problems['D6'] = [1, -3, -40]; // x²-3x-40
        $this->problems['E6'] = [1, 5, -14]; // x²+5x-40
        $this->problems['F6'] = [1, -12, 36]; // x²-12x+36

        $this->problems['A7'] = [1, 18, 81]; // x²+18x+81
        $this->problems['B7'] = [1, 8, -48]; // x²+8x-48
        $this->problems['C7'] = [1, -6, 9]; // x²-6x+9
        $this->problems['D7'] = [1, 6, -91]; // x²+6x-91
        $this->problems['E7'] = [1, 1, -20]; // x²+x-20

        $this->problems['A8'] = [1, 0, -25]; // x²-25
        $this->problems['B8'] = [1, 11, 24]; // x²+11x+24
        $this->problems['C8'] = [1, 3, -18]; // x²+3x-18
        $this->problems['D8'] = [1, 0, -9]; // x²-9

        $this->problems['A9'] = [1, -4, -21]; // x²-4x-21
        $this->problems['B9'] = [1, -1, -12]; // x²-1x-12
        $this->problems['C9'] = [1, 7, -30]; // x²+7x-30
        $this->problems['D9'] = [1, -5, -36]; // x²-5x-36

        $this->problems['A10'] = [1, 8, -33]; // x²+8x-33
        $this->problems['B10'] = [1, 3, 2]; // x²+3x+2
        $this->problems['C10'] = [1, 8, 16]; // x²+8x+16
        $this->problems['D10'] = [1, 1, -30]; // x²+x-30

        $this->problems['A11'] = [1, -2, -8]; // x²-2x-8
        $this->problems['B11'] = [1, 15, 26]; // x²+15x+26
        $this->problems['C11'] = [1, 10, 16]; // x²+10x+16
        $this->problems['D11'] = [1, 7, -8]; // x²+7x-8
    }

    public function render()
    {

        foreach ($this->problems as $pointName => $quadratic) {
            list($a, $b, $c) = $quadratic;
            list($x₁, $x₂) = Algebra::quadratic($a, $b, $c);

            foreach ($this->colors as $color => $answers) {
                if (in_array($x₁, $answers) || in_array($x₂, $answers)) {
                    $this->setColor($color)->plot(new Point($pointName));
                }
            }
        }

        return $this;
    }
}
