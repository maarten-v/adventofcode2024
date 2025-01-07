<?php

require __DIR__ . '/vendor/autoload.php';

/** @var string[] $input */
$input = file('input6.txt', FILE_IGNORE_NEW_LINES);

const UP = 'up';
const DOWN = 'down';
const LEFT = 'left';
const RIGHT = 'right';

$map = [];
$posX = null;
$posY = null;
$direction = 'up';
foreach ($input as $inputIndex => $line) {
    $map[] = str_split($line);
    if (is_null($posX) && str_contains($line, '^')) {
        $posX = strpos($line, '^');
        $posY = $inputIndex;
    }
}

$outOfBounds = false;
$visited = [];
$maxX = count($map[0]);
$maxY = count($map);
while (!$outOfBounds) {
    $visited[$posX . ' ' . $posY] = true;
    if ($direction === UP) {
        $posY--;
    } elseif ($direction === DOWN) {
        $posY++;
    } elseif ($direction === LEFT) {
        $posX--;
    } elseif ($direction === RIGHT) {
        $posX++;
    }
    if ($posX < 0 || $posY < 0 || $posX >= $maxX || $posY >= $maxY) {
        $outOfBounds = true;
        continue;
    }
    if ($map[$posY][$posX] === '#') {
        if ($direction === UP) {
            $posY++;
            $direction = RIGHT;
        } elseif ($direction === DOWN) {
            $posY--;
            $direction = LEFT;
        } elseif ($direction === LEFT) {
            $posX++;
            $direction = UP;
        } elseif ($direction === RIGHT) {
            $posX--;
            $direction = DOWN;
        }
    }
}

echo count($visited);