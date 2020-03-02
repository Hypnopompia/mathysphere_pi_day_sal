<?php
namespace App;

class Frame extends Part
{
    public $x = 1;
    public $y = 1;

    public function getData()
    {
        $this->line(0, 0, 48, 0, Color::COLOR_NAVY); // Top
        $this->line(0, 12, 48, 12, Color::COLOR_NAVY); // Middle Top
        $this->line(0, 24, 48, 24, Color::COLOR_NAVY); // Middle
        $this->line(0, 36, 48, 36, Color::COLOR_NAVY); // Middle Bottom
        $this->line(0, 48, 48, 48, Color::COLOR_NAVY); // Bottome

        $this->line(0, 0, 0, 48, Color::COLOR_NAVY); // Left
        $this->line(12, 13, 12, 48, Color::COLOR_NAVY); // Left Center
        $this->line(24, 0, 24, 48, Color::COLOR_NAVY); // Center
        $this->line(36, 0, 36, 36, Color::COLOR_NAVY); // Right Center
        $this->line(48, 0, 48, 48, Color::COLOR_NAVY); // Right

        return $this->data;
    }
}
