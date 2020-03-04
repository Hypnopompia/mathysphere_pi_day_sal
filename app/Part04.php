<?php
namespace App;

class Part04 extends Part
{
    private $colors = [
        Color::COLOR_CYAN => "D3:H4,H10",
        Color::COLOR_LIGHT_BLUE_GREY => "D6,F6,H6,D8,F8,H8,D10,F10",
        Color::COLOR_SLATE_BLUE => "D2:I10",
        Color::COLOR_NAVY => "C2:I11",
    ];

    public function __construct()
    {
        $this->setOffset(new Point(2, 14));
    }

    public function render()
    {
        foreach ($this->colors as $color => $fillParts) {
            foreach (explode(",", $fillParts) as $coord) {
                if (strpos($coord, ':') === false) {
                    $this->plot(Point::fromCoord($coord), $color);
                } else {
                    $this->fill(Range::fromCoord($coord), $color);
                }
            }
        }

        return $this;
    }
}
