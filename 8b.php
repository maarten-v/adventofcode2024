<?php

require __DIR__ . '/vendor/autoload.php';

/** @var string[] $input */
$fileInput = file('input8.txt', FILE_IGNORE_NEW_LINES);
$input = [];
foreach ($fileInput as $line) {
    $input[] = str_split($line);
}

$frequencies = [];
foreach ($input as $lineIndex => $line) {
    foreach ($line as $charIndex => $char) {
        if ($char === '.') {
            continue;
        }
        $frequencies[$char][] = ['x' => $charIndex, 'y' => $lineIndex];
    }
}
$maxX = count($input[0]);
$maxY = count($input);

$antinodes = [];
foreach ($frequencies as $frequency) {
    foreach ($frequency as $antenna) {
        foreach ($frequency as $otherAntenna) {
            if ($antenna === $otherAntenna) {
                continue;
            }
            $antinodes[] = $antenna['x'] . '-' . $antenna['y'];
            $distanceX = $otherAntenna['x'] - $antenna['x'];
            $distanceY = $otherAntenna['y'] - $antenna['y'];
            $isOutOfBounds = false;
            while ($isOutOfBounds === false) {
                $antinode['x'] = $otherAntenna['x'] + $distanceX;
                $antinode['y'] = $otherAntenna['y'] + $distanceY;
                if (isOutOfBounds($antinode)) {
                    $isOutOfBounds = true;
                    continue;
                }
                $antinodes[] = $antinode['x'] . '-' . $antinode['y'];
                $otherAntenna = $antinode;
            }
        }
    }
}

function isOutOfBounds(array $location): bool
{
    global $maxX, $maxY;
    if ($location['x'] < 0 || $location['x'] >= $maxX) {
        return true;
    }
    if ($location['y'] < 0 || $location['y'] >= $maxY) {
        return true;
    }
    return false;
}

echo count(array_unique($antinodes));