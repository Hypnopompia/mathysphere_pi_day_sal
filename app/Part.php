<?php
namespace App;

class Part
{
    protected $offset = null;
    private $colors = [];
    private $erasing = false;
    private $currentColor;
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

    public function useColor($name, $id)
    {
        if (isset($this->colors[$name])) {
            return $this;
        }
        $this->colors[$name] = new Color($id);

        return $this;
    }

    public function getColors()
    {
        return $this->colors;
    }

    public function setColor($color)
    {
        $this->currentColor = $color;
        return $this;
    }

    public function erase($erase)
    {
        $this->erasing = true;
        switch (get_class($erase)) {
            case 'App\Range':
                $this->fill($erase);
                break;
            case 'App\Point':
                $this->plot($erase);
                break;
        }
        $this->erasing = false;
        return $this;
    }

    public function getColor()
    {
        return $this->currentColor;
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

    public function plot(Point $point, $replace = false)
    {
        if ($this->erasing) {
            unset($this->data[$point->x][$point->y]['color']);
            return $this;
        }

        if ($this->hasColor($point) && !$replace) {
            return $this;
        }

        $this->data[$point->x][$point->y]['color'] = $this->colors[$this->currentColor];

        return $this;
    }

    // Bresenham's line
    // Adapted from https://www.hashbangcode.com/article/drawling-line-pixels-php
    public function line(Point $startPoint, Point $endPoint, $replace = false)
    {
        if ($startPoint->equals($endPoint)) {
            // Start and finish are the same.
            $this->plot($startPoint, $replace);
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
                $this->plot(new Point($startPoint->x, round($slope * $startPoint->x + $pitch)), $replace);
                $startPoint->x += $sx;
            }
        } else {
            // Slope is going upwards.
            $slope = $dx / $dy;
            $pitch = $startPoint->x - $slope * $startPoint->y;

            while ($startPoint->y != $endPoint->y) {
                $this->plot(new Point(round($slope * $startPoint->y + $pitch), $startPoint->y), $replace);
                $startPoint->y += $sy;
            }
        }

        // Finish by adding the final pixel.
        $this->plot($endPoint, $replace);

        return $this;
    }

    public function fill(Range $range, $replace = false)
    {
        for ($x = $range->start->x; $x <= $range->end->x; $x++) {
            for ($y = $range->start->y; $y <= $range->end->y; $y++) {
                $this->plot(new Point($x, $y), $replace);
            }
        }
        return $this;
    }
}
