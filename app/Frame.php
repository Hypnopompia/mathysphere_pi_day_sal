<?php
namespace App;

class Frame
{
    public $x = 1;
    public $y = 1;

    private $data = [];

    public function getData()
    {
        // Top
        for ($i = 0; $i <= 48; $i++) {
            $this->data[] = ['x' => $i, 'y' => 0, 'color' => Color::COLOR_NAVY];
        }

        // Middle Top
        for ($i = 0; $i <= 48; $i++) {
            $this->data[] = ['x' => $i, 'y' => 12, 'color' => Color::COLOR_NAVY];
        }

        // Middle
        for ($i = 0; $i <= 48; $i++) {
            $this->data[] = ['x' => $i, 'y' => 24, 'color' => Color::COLOR_NAVY];
        }

        // Middle Bottom
        for ($i = 0; $i <= 48; $i++) {
            $this->data[] = ['x' => $i, 'y' => 36, 'color' => Color::COLOR_NAVY];
        }

        // Bottom
        for ($i = 0; $i <= 48; $i++) {
            $this->data[] = ['x' => $i, 'y' => 48, 'color' => Color::COLOR_NAVY];
        }

        // Left
        for ($i = 0; $i <= 48; $i++) {
            $this->data[] = ['x' => 0, 'y' => $i, 'color' => Color::COLOR_NAVY];
        }

        // Left Center
        for ($i = 13; $i <= 48; $i++) {
            $this->data[] = ['x' => 12, 'y' => $i, 'color' => Color::COLOR_NAVY];
        }

        // Center
        for ($i = 0; $i <= 48; $i++) {
            $this->data[] = ['x' => 24, 'y' => $i, 'color' => Color::COLOR_NAVY];
        }

        // Right Center
        for ($i = 0; $i <= 36; $i++) {
            $this->data[] = ['x' => 36, 'y' => $i, 'color' => Color::COLOR_NAVY];
        }

        // Right
        for ($i = 0; $i <= 48; $i++) {
            $this->data[] = ['x' => 48, 'y' => $i, 'color' => Color::COLOR_NAVY];
        }

        return $this->data;
    }
}
