<?php

declare(strict_types=1);

require __DIR__ . '/vendor/autoload.php';

/** @var string[] $input */
$fileInput = file('input10.txt', FILE_IGNORE_NEW_LINES);

$input = [];
foreach ($fileInput as $i => $line) {
    foreach (str_split($line) as $j => $char) {
        $input[$i][$j] = (int) $char;
        if ($char === '0') {
            $starts[] = [$i, $j];
        }
    }
}

$found = [];
foreach ($starts as $start) {
    [$startX, $startY] = $start;
    findNext($startX . $startY , $startX, $startY, 1);
}

function findNext(string $start, int $x, int $y, int $number): void
{
    global $input;
    global $found;
    if ($number === 10) {
        $found[$start . $x . $y] = true;
        return;
    }
    if (isset($input[$x - 1][$y]) && $input[$x - 1][$y] === $number) {
        findNext($start, $x - 1, $y, $number + 1);
    }
    if (isset($input[$x][$y - 1]) && $input[$x][$y - 1] === $number) {
        findNext($start, $x, $y - 1, $number + 1);
    }
    if (isset($input[$x][$y + 1]) && $input[$x][$y + 1] === $number) {
        findNext($start, $x, $y + 1, $number + 1);
    }
    if (isset($input[$x + 1][$y]) && $input[$x + 1][$y] === $number) {
        findNext($start, $x + 1, $y, $number + 1);
    }
}

echo count($found, COUNT_RECURSIVE);