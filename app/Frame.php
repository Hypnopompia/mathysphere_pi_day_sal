<?php
namespace App;

class Frame extends Part
{
    private $navy;

    public function __construct()
    {
        $this->setOffset(new Point(1, 1));
        $this->useColor('navy', '336');
    }

    public function render()
    {
        $this->setColor('navy')
            ->line(new Point(0, 0), new Point(48, 0)) // Top
            ->line(new Point(0, 12), new Point(48, 12)) // Middle Top
            ->line(new Point(0, 24), new Point(48, 24)) // Middle
            ->line(new Point(0, 36), new Point(48, 36)) // Middle Bottom
            ->line(new Point(0, 48), new Point(48, 48)) // Bottom
            ->line(new Point(0, 0), new Point(0, 48)) // Left
            ->line(new Point(12, 13), new Point(12, 48)) // Left Center
            ->line(new Point(24, 0), new Point(24, 48)) // Center
            ->line(new Point(36, 0), new Point(36, 36)) // Right Center
            ->line(new Point(48, 0), new Point(48, 48)); // Right

        return $this;
    }
}
