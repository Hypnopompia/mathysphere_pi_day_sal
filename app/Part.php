<?php
namespace App;

class Part
{
    protected $offset;
    protected $data = [];

    public function setOffset(Point $offset)
    {
        $this->offset = $offset;
        return $this;
    }

    public function getOffset()
    {
        return $this->offset ?? new Point(0, 0);
    }

    public function getData()
    {
        return $this->data;
    }

    public function hasColor(Point $point)
    {
        if (isset($this->data[$point->x][$point->y])) {
            return true;
        }
        return false;
    }

    public function plot(Point $point, $color, $replace = false)
    {
        if ($this->hasColor($point) && !$replace) {
            // echo "Warning: " . $x . ":" . $y . " is already set.\n";
            return;
        }
        $this->data[$point->x][$point->y] = ['color' => $color];
        return $this;
    }

    // Bresenham's line
    // Adapted from https://www.hashbangcode.com/article/drawling-line-pixels-php
    public function line(Point $startPoint, Point $endPoint, $color, $replace = false)
    {
        if ($startPoint->equals($endPoint)) {
            // Start and finish are the same.
            $this->plot($startPoint, $color, $replace);
            return;
        }

        $dx = $endPoint->x - $startPoint->x;
        if ($dx < 0) {
            // x1 is lower than x0.
            $sx = -1;
        } else {
            // x1 is higher than x0.
            $sx = 1;
        }

        $dy = $endPoint->y - $startPoint->y;
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
            $pitch = $startPoint->y - $slope * $startPoint->x;

            while ($startPoint->x != $endPoint->x) {
                $this->plot(new Point($startPoint->x, round($slope * $startPoint->x + $pitch)), $color, $replace);
                $startPoint->x += $sx;
            }
        } else {
            // Slope is going upwards.
            $slope = $dx / $dy;
            $pitch = $startPoint->x - $slope * $startPoint->y;

            while ($startPoint->y != $endPoint->y) {
                $this->plot(new Point(round($slope * $startPoint->y + $pitch), $startPoint->y), $color, $replace);
                $startPoint->y += $sy;
            }
        }

        // Finish by adding the final pixel.
        $this->plot($endPoint, $color, $replace);

        return $this;
    }

    public function fill(Range $range, $color, $replace = false)
    {
        for ($x = $range->start->x; $x <= $range->end->x; $x++) {
            for ($y = $range->start->y; $y <= $range->end->y; $y++) {
                $this->plot(new Point($x, $y), $color, $replace);
            }
        }
        return $this;
    }
}
