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

        $this->problems = [
            'H1' => 'x²-49',
            'I1' => 'x²+2x-48',
            'J1' => 'x²-3x-70',
            'K1' => 'x²-1x-72',

            'H2' => 'x²+12x-13',
            'I2' => 'x²+9x-10',
            'J2' => 'x²+5x+4',
            'K2' => 'x²-8x+12',

            'G3' => 'x²-4x-60',
            'H3' => 'x²-21x+108',
            'I3' => 'x²-7x+10',
            'J3' => 'x²+6x+5',
            'K3' => 'x²+2-35',

            'F4' => 'x²+4x-45',
            'G4' => 'x²+11x-26',
            'H4' => 'x²+13x+40',

            'E5' => 'x²+2x-35',
            'F5' => 'x²+2x+1',
            'G5' => 'x²+9x+8',

            'D6' => 'x²-3x-40',
            'E6' => 'x²+5x-14',
            'F6' => 'x²-12x+36',

            'A7' => 'x²+18x+81',
            'B7' => 'x²+8x-48',
            'C7' => 'x²-6x+9',
            'D7' => 'x²+6x-91',
            'E7' => 'x²+x-20',

            'A8' => 'x²-25',
            'B8' => 'x²+11x+24',
            'C8' => 'x²+3x-18',
            'D8' => 'x²-9',

            'A9' => 'x²-4x-21',
            'B9' => 'x²-1x-12',
            'C9' => 'x²+7x-30',
            'D9' => 'x²-5x-36',

            'A10' => 'x²+8x-33',
            'B10' => 'x²+3x+2',
            'C10' => 'x²+8x+16',
            'D10' => 'x²+x-30',

            'A11' => 'x²-2x-8',
            'B11' => 'x²+15x+26',
            'C11' => 'x²+10x+16',
            'D11' => 'x²+7x-8',
        ];
    }

    private function parseQuadratic($string)
    {
        if (preg_match('/(\\d*)x²(?:([+\\-]\\d*)x)?([+\\-]\\d*)?/', $string, $coefficients)) {
            $a = ($coefficients[1] != "") ? (int) $coefficients[1] : 1;
            $b = ($coefficients[2] != "") ? (int) $coefficients[2] : 0;
            $c = ($coefficients[3] != "") ? (int) $coefficients[3] : 0;
        } else {
            throw new \Exception('Quadratic parse error: ' . $string);
        }

        return [$a, $b, $c];
    }

    public function render()
    {

        foreach ($this->problems as $pointName => $quadratic) {
            list($a, $b, $c) = $this->parseQuadratic($quadratic);
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
