<?php
require 'ansi-color.php';
use PhpAnsiColor\Color;

$rows = [
    [null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null],
    [null, 3, -3, 37, 27, -7, 59, 38, -9, 36, 30, -1, 81, 29, -7, 53, -11, 49, 35, null, null, null, null],
    [null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null],
    [null, 15, 5, 38, 41, 36, 33, 24, pow(7, 2), 29, 67, -17, 51, 27, 22, -2, 22, -8, 55, null, null, null, null],
    [null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null],
    [null, 6, 11, 10, 18, -1, 34, 57, 0, 47, -13, 55, -14, 61, 47, 30, -5, 39, 66, null, null, null, null],
    [null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null],
    [null, 12, M_E, 16, 8, 17, 9, pow(4, 2), 1, 37, 36, -3, -3, 52, 44, pow(5, 2), 58, 38, 35, null, null, null, null],
    [null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null],
    [null, 9, sqrt(144), M_PI, 4 * M_PI, 2, 13, 6, 11, 4, 14, sqrt(2), 13, 7, 20, 1 / 2, 19, 38, 67, null, null, null, null],
    [null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null],
];

foreach ($rows as $row) {
    foreach ($row as $cell) {
        $cyanFormula = (-(1 / 2) * $cell) + 2;
        $navyFormula = (1.9 * $cell) + 1;

        if (-3 <= $cyanFormula && $cyanFormula < 2) {
            echo Color::set("C", "cyan");
        } elseif (20 < $navyFormula && $navyFormula <= 39) {
            echo Color::set("N", "blue");
        } else {
            echo Color::set(".", "white");
        }

    }
    echo "\n";
}