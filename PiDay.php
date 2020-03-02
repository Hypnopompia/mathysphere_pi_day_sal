<?php
require "vendor/autoload.php";

use App\Color;

class PiDay
{
    private $includeParts = [
        App\Frame::class,
        App\Part01::class, // March 1, 2020
        App\Part02::class, // March 2, 2020
    ];

    private $parts = [];
    private $colors = [];

    private $image;
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
    }

    public function run()
    {
        foreach ($this->includeParts as $part) {
            $this->parts[] = new $part();
        }

        $this->createImage();
        $this->allocateColors();

        foreach ($this->parts as $part) {
            $this->render($part->x, $part->y, $part->render()->getData());
        }

        $this->drawGrid(Color::COLOR_BLACK);

        $this->saveImage();
    }

    public function createImage()
    {
        $this->image = imagecreatetruecolor($this->imageWidth, $this->imageHeight);
    }

    public function allocateColors()
    {
        $this->colors[Color::COLOR_BACKGROUND] = Color::allocate($this->image, Color::COLOR_BACKGROUND);
        imagefill($this->image, 0, 0, $this->colors[Color::COLOR_BACKGROUND]);
        $this->colors[Color::COLOR_BLACK] = Color::allocate($this->image, Color::COLOR_BLACK);

        $this->colors[Color::COLOR_CYAN] = Color::allocate($this->image, Color::COLOR_CYAN);
        $this->colors[Color::COLOR_LIGHT_BLUE_GREY] = Color::allocate($this->image, Color::COLOR_LIGHT_BLUE_GREY);
        $this->colors[Color::COLOR_SLATE_BLUE] = Color::allocate($this->image, Color::COLOR_SLATE_BLUE);
        $this->colors[Color::COLOR_NAVY] = Color::allocate($this->image, Color::COLOR_NAVY);
        $this->colors[Color::COLOR_WHITE] = Color::allocate($this->image, Color::COLOR_WHITE);
    }

    public function drawGrid($color)
    {
        for ($x = 0; $x <= $this->xSquares; $x++) {
            imageline(
                $this->image,
                $x * $this->pixelsPerSquare, // x1
                0, // y1
                $x * $this->pixelsPerSquare, // x2
                $this->imageHeight, // y2
                $this->colors[$color]
            );
        }

        for ($y = 0; $y <= $this->ySquares; $y++) {
            imageline(
                $this->image,
                0, // x1
                $y * $this->pixelsPerSquare, // y1
                $this->imageWidth, // x2
                $y * $this->pixelsPerSquare, //y2
                $this->colors[$color]
            );
        }
    }

    public function render($x, $y, $data)
    {
        foreach ($data as $square) {
            $this->drawSquare($x + $square['x'], $y + $square['y'], $square['color']);
        }
    }

    public function drawSquare($x, $y, $color)
    {
        $x1 = $x * $this->pixelsPerSquare + 1;
        $y1 = $y * $this->pixelsPerSquare + 1;
        $x2 = (($x + 1) * $this->pixelsPerSquare) - 1;
        $y2 = (($y + 1) * $this->pixelsPerSquare) - 1;
        imagefilledrectangle($this->image, $x1, $y1, $x2, $y2, $this->colors[$color]);
        imagettftext($this->image, 12, 0, $x1 + 2, $y1 + 12, $this->colors[Color::getTextColor($color)], './arial.ttf', Color::getSymbol($color));
    }

    public function saveImage()
    {
        imagepng($this->image, 'solutions/PiDay.png');
        imagedestroy($this->image);
    }
}

$piDay = new PiDay();
$piDay->run();
