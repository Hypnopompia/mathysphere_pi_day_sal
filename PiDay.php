<?php
require "vendor/autoload.php";

use App\Color;
use App\Point;

class PiDay
{
    private $includeParts = [
        App\Frame::class,
        App\Part01::class, // March 1, 2020
        App\Part02::class, // March 2, 2020
        App\Part03::class, // March 3, 2020
        App\Part04::class, // March 4, 2020
        App\Part05::class, // March 5, 2020
        App\Part06::class, // March 6, 2020
        App\Part07::class, // March 7, 2020
    ];

    private $parts = [];
    private $colors = [];
    private $symbolMap = [
        '3846' => '≈', // Cyan
        '932' => 'e', // Light Blue-Grey
        '930' => '∞', // Slate Blue
        '336' => 'π', // Navy
        'B5200' => '%', // White
    ];

    private $image;
    private $backgroundColor;
    private $gridColor;

    private $xSquares = 51;
    private $ySquares = 51;
    private $pixelsPerSquare;
    private $imageWidth;
    private $imageHeight;

    public function __construct($pixelsPerSquare = 15)
    {
        $this->pixelsPerSquare = $pixelsPerSquare;
        $this->imageWidth = $this->xSquares * $this->pixelsPerSquare + 1;
        $this->imageHeight = $this->ySquares * $this->pixelsPerSquare + 1;
        $this->backgroundColor = new Color('B5200'); // White
        $this->gridColor = new Color('310'); // Black
    }

    public function run()
    {
        $this->createImage();

        foreach ($this->includeParts as $partName) {
            $part = new $partName();
            $part->render();
            $this->includeColors($part->getColors());
            $this->render($part->getOffset(), $part->getData());
        }

        $this->drawGrid();

        $this->saveImage();
    }

    private function includeColors($colors)
    {
        if (!is_array($colors)) {
            $colors = [$colors];
        }

        foreach ($colors as $color) {
            // Allocate the background color, if needed
            if (!isset($this->colors[$color->getId()])) {
                $color->allocate($this->image);
                $this->colors[$color->getId()] = $color;
            }

            // Allocate the text color, if needed
            $textColor = $color->getContrastColor();
            if (!isset($this->colors[$textColor->getId()])) {
                $textColor->allocate($this->image);
                $this->colors[$textColor->getId()] = $textColor;
            }
        }
    }

    private function color($key)
    {
        if (is_object($key)) {
            $key = $key->getId();
        }
        return $this->colors[$key];
    }

    private function imageColor($key)
    {
        return $this->color($key)->getGdColor();
    }

    private function createImage()
    {
        $this->image = imagecreatetruecolor($this->imageWidth, $this->imageHeight);
        $this->includeColors($this->backgroundColor);
        imagefill($this->image, 0, 0, $this->imageColor($this->backgroundColor));
        $this->includeColors($this->gridColor);
    }

    private function drawGrid()
    {
        for ($x = 0; $x <= $this->xSquares; $x++) {
            imageline(
                $this->image,
                $x * $this->pixelsPerSquare, // x1
                0, // y1
                $x * $this->pixelsPerSquare, // x2
                $this->imageHeight, // y2
                $this->imageColor($this->gridColor)
            );
        }

        for ($y = 0; $y <= $this->ySquares; $y++) {
            imageline(
                $this->image,
                0, // x1
                $y * $this->pixelsPerSquare, // y1
                $this->imageWidth, // x2
                $y * $this->pixelsPerSquare, //y2
                $this->imageColor($this->gridColor)
            );
        }
    }

    private function render(Point $offset, $data)
    {
        foreach ($data as $x => $row) {
            foreach ($row as $y => $cell) {
                if (isset($cell['color'])) {
                    $this->drawSquare($offset->x + $x, $offset->y + $y, $cell['color']);
                }
            }
        }
    }

    private function drawSquare($x, $y, $color)
    {
        $x1 = $x * $this->pixelsPerSquare + 1;
        $y1 = $y * $this->pixelsPerSquare + 1;
        $x2 = (($x + 1) * $this->pixelsPerSquare) - 1;
        $y2 = (($y + 1) * $this->pixelsPerSquare) - 1;
        imagefilledrectangle($this->image, $x1, $y1, $x2, $y2, $this->imageColor($color));
        $textColor = $color->getContrastColor();
        $symbol = $this->symbolMap[$color->getId()];
        imagettftext($this->image, 12, 0, $x1 + 2, $y1 + 12, $this->imageColor($textColor), './arial.ttf', $symbol);
    }

    private function saveImage()
    {
        imagepng($this->image, 'solutions/PiDay.png');
        imagedestroy($this->image);
    }
}

$piDay = new PiDay();
$piDay->run();
