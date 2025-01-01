<?php
require __DIR__ . '/vendor/autoload.php';

const UNCHANGED = 0;
const ASCENDING = 1;
const DESCENDING = -1;
const WORD_ARRAY = ['X', 'M', 'A', 'S'];

/** @var string[] $input */
$fileInput = file('input4.txt', FILE_IGNORE_NEW_LINES);
$input = [];
foreach ($fileInput as $line) {
    $input[] = str_split($line);
}
$total = 0;

foreach ($input as $lineIndex => $line) {
    foreach ($line as $charIndex => $char) {
        if ($char !== 'X') {
            continue;
        }
        // West
        if (wordFound($input, $lineIndex, $charIndex, DESCENDING, UNCHANGED)) {
            $total++;
        }
        // North West
        if (wordFound($input, $lineIndex, $charIndex, DESCENDING, DESCENDING)) {
            $total++;
        }
        // South West
        if (wordFound($input, $lineIndex, $charIndex, DESCENDING, ASCENDING)) {
            $total++;
        }
        // North
        if (wordFound($input, $lineIndex, $charIndex, UNCHANGED, DESCENDING)) {
            $total++;
        }
        // North East
        if (wordFound($input, $lineIndex, $charIndex, ASCENDING, DESCENDING)) {
            $total++;
        }
        // East
        if (wordFound($input, $lineIndex, $charIndex, ASCENDING, UNCHANGED)) {
            $total++;
        }
        // South East
        if (wordFound($input, $lineIndex, $charIndex, ASCENDING, ASCENDING)) {
            $total++;
        }
        // South
        if (wordFound($input, $lineIndex, $charIndex, UNCHANGED, ASCENDING)) {
            $total++;
        }
    }
}

function wordFound(array $input, int $line, int $char, int $charDirection, int $lineDirection): bool
{
    if ($charDirection === ASCENDING && count($input[0]) - $char <= 3) {
        return false;
    }
    if ($charDirection === DESCENDING && $char < 3) {
        return false;
    }
    if ($lineDirection === ASCENDING && count($input) - $line <= 3) {
        return false;
    }
    if ($lineDirection === DESCENDING && $line < 3) {
        return false;
    }

    for ($i = 1; $i <= 3; $i++) {
        $char += $charDirection;
        $line += $lineDirection;
        if ($input[$line][$char] !== WORD_ARRAY[$i]) {
            return false;
        }
    }
    return true;
}

echo $total;