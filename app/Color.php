<?php
namespace App;

class Color
{
    const COLOR_BACKGROUND = 0;
    const COLOR_BLACK = 1;
    const COLOR_CYAN = 2;
    const COLOR_LIGHT_BLUE_GREY = 3;
    const COLOR_SLATE_BLUE = 4;
    const COLOR_NAVY = 5;
    const COLOR_WHITE = 6;

    const COLORS = [
        Color::COLOR_BACKGROUND => [
            'symbol' => ' ',
            'r' => 255,
            'g' => 255,
            'b' => 255,
            'text' => Color::COLOR_BLACK,
        ],

        Color::COLOR_BLACK => [
            'symbol' => ' ',
            'r' => 0,
            'g' => 0,
            'b' => 0,
            'text' => Color::COLOR_WHITE,
        ],

        Color::COLOR_CYAN => [
            'symbol' => '@',
            'r' => 6,
            'g' => 227,
            'b' => 230,
            'text' => Color::COLOR_BLACK,
        ],

        Color::COLOR_LIGHT_BLUE_GREY => [
            'symbol' => 'E',
            'r' => 162,
            'g' => 181,
            'b' => 198,
            'text' => Color::COLOR_BLACK,
        ],

        Color::COLOR_SLATE_BLUE => [
            'symbol' => '#',
            'r' => 69,
            'g' => 92,
            'b' => 113,
            'text' => Color::COLOR_WHITE,
        ],

        Color::COLOR_NAVY => [
            'symbol' => '$',
            'r' => 37,
            'g' => 59,
            'b' => 115,
            'text' => Color::COLOR_WHITE,
        ],

        Color::COLOR_WHITE => [
            'symbol' => '%',
            'r' => 255,
            'g' => 255,
            'b' => 255,
            'text' => Color::COLOR_BLACK,
        ],
    ];

    public static function allocate(&$image, $color)
    {
        return imagecolorallocate($image,
            Color::COLORS[$color]['r'],
            Color::COLORS[$color]['g'],
            Color::COLORS[$color]['b']
        );
    }

    public static function getSymbol($color)
    {
        return Color::COLORS[$color]['symbol'];
    }

    public static function getTextColor($color)
    {
        return Color::COLORS[$color]['text'];
    }
}
