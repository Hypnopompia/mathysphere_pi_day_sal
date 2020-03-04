<?php
namespace App;

class Range
{
    private $startPoint;
    private $endPoint;

    public function __construct(Point $startPoint = null, Point $endPoint = null)
    {
        if ($startPoint) {
            $this->setStartPoint($startPoint);
        }

        if ($endPoint) {
            $this->setEndPoint($endPoint);
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

    public static function fromCoord($coord)
    {
        $coords = explode(":", $coord);
        return new Range(Point::fromCoord($coords[0]), Point::fromCoord($coords[1]));
    }
}
