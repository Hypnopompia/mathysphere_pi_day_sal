<?php
namespace App;

use App\Color;

class Part02 extends Part
{
    public $x = 26;
    public $y = 2;

    private $xPos;
    private $yPos;

    public function __construct()
    {
        $this->line(5, 0, 5, 4, Color::COLOR_NAVY); // Top
        $this->line(1, 5, 4, 5, Color::COLOR_NAVY); // Left
        $this->line(6, 5, 9, 5, Color::COLOR_NAVY); // Right
        $this->line(5, 6, 5, 10, Color::COLOR_NAVY); // Bottom

    }

    public function render()
    {
        $this->xPos = 0;
        $this->yPos = 4;
        $this->plot($this->xPos, $this->yPos, Color::COLOR_LIGHT_BLUE_GREY); // Start at A5

        $this->moveAndPlot('S', 1, Color::COLOR_LIGHT_BLUE_GREY); // S 1
        $this->moveAndPlot('SE', 2, Color::COLOR_LIGHT_BLUE_GREY); // SE 2
        $this->moveAndPlot('E', 1, Color::COLOR_LIGHT_BLUE_GREY); // E 1
        $this->moveAndPlot('NE', 4, Color::COLOR_LIGHT_BLUE_GREY); // NE 4
        $this->moveAndPlot('E', 1, Color::COLOR_LIGHT_BLUE_GREY); // E 1
        $this->moveAndPlot('SE', 2, Color::COLOR_LIGHT_BLUE_GREY); // SE 2
        $this->moveAndPlot('S', 1, Color::COLOR_LIGHT_BLUE_GREY); // S 1
        // Tie Off

        return $this;
    }

    public function moveAndPlot($directions, $steps, $color)
    {
        for ($i = 0; $i < $steps; $i++) {
            foreach (str_split($directions) as $direction) {
                switch ($direction) {
                    case "N":
                        $this->yPos--;
                        break;
                    case "S":
                        $this->yPos++;
                        break;
                    case "E":
                        $this->xPos++;
                        break;
                    case "W":
                        $this->xPos--;
                        break;
                }
            }

            $this->plot($this->xPos, $this->yPos, $color);
        }
    }
}
