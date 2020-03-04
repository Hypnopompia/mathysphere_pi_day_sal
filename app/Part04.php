<?php
namespace App;

class Part04 extends Part
{
    private $colors = [
        'cyan' => ["D3:H4", "H10"],
        'blueGrey' => ["D6", "F6", "H6", "D8", "F8", "H8", "D10", "F10"],
        'slateBlue' => ["D2:I10"],
        'navy' => ["C2:I11"],
    ];

    public function __construct()
    {
        $this->setOffset(new Point(2, 14));
        $this->useColor('cyan', '3846');
        $this->useColor('blueGrey', '932');
        $this->useColor('slateBlue', '930');
        $this->useColor('navy', '336');
    }

    public function render()
    {
        foreach ($this->colors as $color => $ranges) {
            foreach ($ranges as $range) {
                $this->setColor($color)->fill(new Range($range));
            }
        }

        return $this;
    }
}
