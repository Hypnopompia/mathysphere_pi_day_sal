<?php
namespace App;

use App\Color;

class Part03 extends Part
{
    private $rows;

    public function __construct()
    {
        $this->setOffset(new Point(38, 2));
        $this->rows = [
            0 => [4, 4, 4, 4, 4, 4, 4, 4, 4, 4, 4],
            1 => [4, 4, 1, 1, 1, 4, 4, 4, 4, 4, 4],
            2 => [4, 1, 0, 0, 0, 1, 1, 4, 4, 4, 4],
            3 => [4, 1, 1, 1, 1, 1, 4, 1, 4, 4, 4],
            4 => [4, 1, 1, 1, 1, 1, 4, 1, 4, 4, 4],
            5 => [4, 1, 1, 1, 1, 1, 1, 4, 4, 4, 4],
            6 => [4, 1, 1, 1, 1, 2, 2, 2, 2, 4, 4],
            7 => [4, 4, 1, 1, 2, 2, 4, 4, 2, 2, 4],
            8 => [4, 4, 4, 4, 2, 2, 2, 2, 2, 2, 4],
            9 => [4, 4, 4, 4, 4, 2, 2, 2, 2, 4, 4],
            10 => [4, 4, 4, 4, 4, 4, 4, 4, 4, 4, 4],
        ];
    }

    public function render()
    {
        foreach ($this->rows as $y => $row) {
            foreach ($row as $x => $cell) {
                switch ($cell) {
                    case 0:
                        $this->plot(new Point($x, $y), Color::COLOR_NAVY);
                        break;
                    case 1:
                        $this->plot(new Point($x, $y), Color::COLOR_LIGHT_BLUE_GREY);
                        break;
                    case 2:
                        $this->plot(new Point($x, $y), Color::COLOR_CYAN);
                        break;
                }
            }
        }

        return $this;
    }
}
