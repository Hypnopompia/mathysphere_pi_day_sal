<?php
namespace App;

class Part03 extends Part
{
    private $colors = [
        0 => 'navy',
        1 => 'blueGrey',
        2 => 'cyan',
    ];

    private $rows = [
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

    public function __construct()
    {
        $this->setOffset(new Point(38, 2));
        $this->useColor('cyan', '3846');
        $this->useColor('blueGrey', '932');
        $this->useColor('navy', '336');
    }

    public function render()
    {
        foreach ($this->rows as $y => $row) {
            foreach ($row as $x => $cell) {
                if (isset($this->colors[$cell])) {
                    $this->setColor($this->colors[$cell])->plot(new Point($x, $y));
                }
            }
        }

        return $this;
    }
}
