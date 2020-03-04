<?php
namespace App;

use App\Color;

class Part02 extends Part
{
    private $position;

    public function __construct()
    {
        $this->setOffset(new Point(26, 2));
        $this->line(Point::fromCoord("F1"), Point::fromCoord("F5"), Color::COLOR_NAVY); // Top
        $this->line(Point::fromCoord("B6"), Point::fromCoord("E6"), Color::COLOR_NAVY); // Left
        $this->line(Point::fromCoord("G6"), Point::fromCoord("J6"), Color::COLOR_NAVY); // Right
        $this->line(Point::fromCoord("F7"), Point::fromCoord("F11"), Color::COLOR_NAVY); // Bottom
    }

    public function render()
    {
        $this->position = Point::fromCoord("A5"); // Start at A5
        $this->plot($this->position, Color::COLOR_LIGHT_BLUE_GREY);

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
            $this->position->move($directions);
            $this->plot($this->position, $color);
        }
    }
}
