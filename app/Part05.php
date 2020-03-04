<?php
namespace App;

class Part05 extends Part
{
    public function __construct()
    {
        $this->setOffset(new Point(14, 14));
    }

    public function render()
    {

        return $this;
    }
}
