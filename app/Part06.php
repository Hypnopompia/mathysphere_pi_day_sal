<?php
namespace App;

class Part06 extends Part
{
    public function __construct()
    {
        $this->setOffset(new Point(26, 14));
        $this->useColor('slateBlue', '930');
    }

    public function render()
    {
        $this->setColor('slateBlue');

        $panelSize = 11;

        // 1. Start with a 9x9 square centered in the panel.
        $largeSquareSize = 9; // 9x9
        $largeSquareOffset = ($panelSize - $largeSquareSize) / 2; // Centered

        $largeSquareRange = new Range(
            new Point($largeSquareOffset, $largeSquareOffset),
            new Point($largeSquareOffset + $largeSquareSize - 1, $largeSquareOffset + $largeSquareSize - 1)
        );

        $this->fill($largeSquareRange);

        // 2. Divide the square into nine equally-sized smaller squares
        $smallSquares = [];
        $smallSquareSize = $largeSquareSize / 3;

        for ($x = 0; $x <= 2; $x++) {
            for ($y = 0; $y <= 2; $y++) {
                $startPoint = new Point($x * $smallSquareSize + $largeSquareOffset, $y * $smallSquareSize + $largeSquareOffset);
                $endPoint = new Point($startPoint->x + $smallSquareSize - 1, $startPoint->y + $smallSquareSize - 1);
                $smallSquares[$y][$x] = new Range($startPoint, $endPoint);
            }
        }

        // 3. Remove the square in the center.
        $this->erase($smallSquares[1][1]);

        // 4. Repeat steps 2 & 3 for each of the eight remaining squares.
        foreach ($smallSquares as $y => $rows) {
            foreach ($rows as $x => $square) {
                $this->erase($square->getMiddlePoint());
            }
        }

        return $this;
    }
}
