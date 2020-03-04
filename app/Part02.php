<?php
namespace App;

use App\Color;

class Part02 extends Part
{
    private $position;

    public function __construct()
    {
        $this->setOffset(new Point(26, 2));
        $this->line(new Point("F1"), new Point("F5"), Color::COLOR_NAVY); // Top
        $this->line(new Point("B6"), new Point("E6"), Color::COLOR_NAVY); // Left
        $this->line(new Point("G6"), new Point("J6"), Color::COLOR_NAVY); // Right
        $this->line(new Point("F7"), new Point("F11"), Color::COLOR_NAVY); // Bottom
    }

    public function render()
    {
        $lineColor = Color::COLOR_LIGHT_BLUE_GREY;
        $this->position = new Point("A5"); // Start at A5
        $this->plot($this->position, $lineColor)
            ->moveAndPlot('S', 1, $lineColor) // S 1
            ->moveAndPlot('SE', 2, $lineColor) // SE 2
            ->moveAndPlot('E', 1, $lineColor) // E 1
            ->moveAndPlot('NE', 4, $lineColor) // NE 4
            ->moveAndPlot('E', 1, $lineColor) // E 1
            ->moveAndPlot('SE', 2, $lineColor) // SE 2
            ->moveAndPlot('S', 1, $lineColor); // S 1
        // Tie Off

        return $this;
    }

    public function moveAndPlot($directions, $steps, $color)
    {
        for ($i = 0; $i < $steps; $i++) {
            $this->position->move($directions);
            $this->plot($this->position, $color);
        }

        return $this;
    }
}
