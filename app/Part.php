<?php
namespace App;

class Part
{
    protected $data = [];

    public function plot($x, $y, $color)
    {
        $this->data[] = ['x' => $x, 'y' => $y, 'color' => $color];
    }

    // Bresenham's line
    // Adapted from https://www.hashbangcode.com/article/drawling-line-pixels-php
    public function line($x0, $y0, $x1, $y1, $color)
    {
        if ($x0 == $x1 && $y0 == $y1) {
            // Start and finish are the same.
            $this->plot($x0, $y0, $color);
            return;
        }

        $dx = $x1 - $x0;
        if ($dx < 0) {
            // x1 is lower than x0.
            $sx = -1;
        } else {
            // x1 is higher than x0.
            $sx = 1;
        }

        $dy = $y1 - $y0;
        if ($dy < 0) {
            // y1 is lower than y0.
            $sy = -1;
        } else {
            // y1 is higher than y0.
            $sy = 1;
        }

        if (abs($dy) < abs($dx)) {
            // Slope is going downwards.
            $slope = $dy / $dx;
            $pitch = $y0 - $slope * $x0;

            while ($x0 != $x1) {
                $this->plot($x0, round($slope * $x0 + $pitch), $color);
                $x0 += $sx;
            }
        } else {
            // Slope is going upwards.
            $slope = $dx / $dy;
            $pitch = $x0 - $slope * $y0;

            while ($y0 != $y1) {
                $this->plot(round($slope * $y0 + $pitch), $y0, $color);
                $y0 += $sy;
            }
        }

        // Finish by adding the final pixel.
        $this->plot($x1, $y1, $color);
    }
}
