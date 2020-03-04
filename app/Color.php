<?php
namespace App;

class Color
{
    private $id;
    private $name;
    private $r;
    private $g;
    private $b;
    private $gdColor;

    public function __construct($id)
    {
        $this->setDMCColor($id);

    }

    public function getId()
    {
        return $this->id;
    }

    private function setDMCColor($id)
    {
        if (($handle = fopen("dmc.csv", "r")) !== false) {
            while (($data = fgetcsv($handle, 1000, ",")) !== false) {
                if ($data[0] == $id) {
                    $this->id = $data[0];
                    $this->name = $data[1];
                    $this->r = $data[2];
                    $this->g = $data[3];
                    $this->b = $data[4];
                }
            }
            fclose($handle);
        }
    }

    public function allocate(&$image)
    {
        $this->gdColor = imagecolorallocate($image,
            $this->r,
            $this->g,
            $this->b
        );
        return $this;
    }

    public function getGdColor()
    {
        return $this->gdColor;
    }

    public function getContrastColor()
    {
        $yiq = (($this->r * 299) + ($this->g * 587) + ($this->b * 114)) / 1000;
        return ($yiq >= 128) ? new Color('310') : new Color('B5200');
    }
}
