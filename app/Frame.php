<?php
namespace App;

class Frame extends Part
{
    public function __construct()
    {
        $this->setOffset(new Point(1, 1));
    }

    public function render()
    {
        $this->line(new Point(0, 0), new Point(48, 0), Color::COLOR_NAVY); // Top
        $this->line(new Point(0, 12), new Point(48, 12), Color::COLOR_NAVY); // Middle Top
        $this->line(new Point(0, 24), new Point(48, 24), Color::COLOR_NAVY); // Middle
        $this->line(new Point(0, 36), new Point(48, 36), Color::COLOR_NAVY); // Middle Bottom
        $this->line(new Point(0, 48), new Point(48, 48), Color::COLOR_NAVY); // Bottom

        $this->line(new Point(0, 0), new Point(0, 48), Color::COLOR_NAVY); // Left
        $this->line(new Point(12, 13), new Point(12, 48), Color::COLOR_NAVY); // Left Center
        $this->line(new Point(24, 0), new Point(24, 48), Color::COLOR_NAVY); // Center
        $this->line(new Point(36, 0), new Point(36, 36), Color::COLOR_NAVY); // Right Center
        $this->line(new Point(48, 0), new Point(48, 48), Color::COLOR_NAVY); // Right

        return $this;
    }
}
