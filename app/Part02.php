<?php
namespace App;

class Part02 extends Part
{
    private $position;

    public function __construct()
    {
        $this->setOffset(new Point(26, 2));
        $this->useColor('blueGrey', '932');
        $this->useColor('navy', '336');

        $this->setColor('navy')
            ->line(new Point("F1"), new Point("F5")) // Top
            ->line(new Point("B6"), new Point("E6")) // Left
            ->line(new Point("G6"), new Point("J6")) // Right
            ->line(new Point("F7"), new Point("F11")); // Bottom
    }

    public function render()
    {
        $this->position = new Point("A5"); // Start at A5
        $this->setColor('blueGrey')
            ->plot($this->position)
            ->moveAndPlot('S', 1) // S 1
            ->moveAndPlot('SE', 2) // SE 2
            ->moveAndPlot('E', 1) // E 1
            ->moveAndPlot('NE', 4) // NE 4
            ->moveAndPlot('E', 1) // E 1
            ->moveAndPlot('SE', 2) // SE 2
            ->moveAndPlot('S', 1); // S 1
        // Tie Off

        return $this;
    }

    public function moveAndPlot($directions, $steps)
    {
        for ($i = 0; $i < $steps; $i++) {
            $this->position->move($directions);
            $this->plot($this->position);
        }

        return $this;
    }
}
