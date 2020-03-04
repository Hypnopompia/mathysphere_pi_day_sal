<?php
namespace App;

class Point
{
    private $position;

    public function __construct($x = null, $y = null)
    {
        $this->position['x'] = $x;
        $this->position['y'] = $y;
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

    }

    public static function fromCoord($coordinate)
    {
        list($x, $y) = self::getCoordinatesPositions($coordinate);
        return new Point($x - 1, $y - 1);
    }

    private static function getCoordinatesPositions($coordinates)
    {
        if (preg_match('/^([a-z]+)(\d+)$/i', $coordinates, $matches)) {
            $level = strlen($matches[1]);
            $matches[1] = array_reduce(
                str_split(strtoupper($matches[1])),
                function ($result, $letter) use (&$level) {
                    return $result + (ord($letter) - 64) * pow(26, --$level);
                }
            );
            return array_splice($matches, 1);
        }
        // (returns NULL when wrong $coordinates)
    }
}
