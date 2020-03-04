<?php
namespace App;

class Point
{
    private $position;

    public function __construct()
    {
        $args = func_get_args();

        if (count($args) == 1) {
            $this->setCoord($args[0]);
        } else {
            $this->position['x'] = $args[0];
            $this->position['y'] = $args[1];
        }
    }

    public function __set($key, $value)
    {
        if (in_array($key, ['x', 'y'])) {
            $this->position[$key] = $value;
        }

        return $this;
    }

    public function __get($key)
    {
        if (in_array($key, ['x', 'y']) && isset($this->position[$key])) {
            return $this->position[$key];
        }

        return null;
    }

    public function equals(Point $point)
    {
        return ($this->x === $point->x && $this->y === $point->y);
    }

    public function move($directions)
    {
        foreach (str_split($directions) as $direction) {
            switch ($direction) {
                case "N":
                    $this->position['y']--;
                    break;
                case "S":
                    $this->position['y']++;
                    break;
                case "E":
                    $this->position['x']++;
                    break;
                case "W":
                    $this->position['x']--;
                    break;
            }
        }

        return $this;
    }

    public function setCoord($coordinates)
    {
        if (preg_match('/^([a-z]+)(\d+)$/i', $coordinates, $matches)) {
            $level = strlen($matches[1]);
            $matches[1] = array_reduce(
                str_split(strtoupper($matches[1])),
                function ($result, $letter) use (&$level) {
                    return $result + (ord($letter) - 64) * pow(26, --$level);
                }
            );
            $coord = array_splice($matches, 1);

            $this->position['x'] = $coord[0] - 1;
            $this->position['y'] = $coord[1] - 1;
        }

        return $this;
    }
}
