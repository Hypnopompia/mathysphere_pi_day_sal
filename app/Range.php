<?php
namespace App;

class Range
{
    private $startPoint;
    private $endPoint;

    public function __construct()
    {
        $args = func_get_args();

        if (count($args) == 1) {
            $this->setCoordRange($args[0]);
        } else {
            $this->setStartPoint($args[0]);
            $this->setEndPoint($args[1]);
        }
    }

    public function setStartPoint(Point $startPoint)
    {
        $this->startPoint = $startPoint;
        return $this;
    }

    public function setEndPoint(Point $endPoint)
    {
        $this->endPoint = $endPoint;
        return $this;
    }

    public function getStartPoint()
    {
        return $this->startPoint;
    }

    public function getEndPoint()
    {
        return $this->endPoint;
    }

    public function __get($key)
    {
        switch ($key) {
            case 'start':
                return $this->getStartPoint();
                break;
            case 'end':
                return $this->getEndPoint();
                break;
        }
        return null;
    }

    public function setCoordRange($coord)
    {
        if (strpos($coord, ':') === false) {
            $this->setStartPoint(new Point($coord))->setEndPoint(new Point($coord));
            return $this;
        }

        $coords = explode(":", $coord);
        $this->setStartPoint(new Point($coords[0]))->setEndPoint(new Point($coords[1]));

        return $this;
    }
}
