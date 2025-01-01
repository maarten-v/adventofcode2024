<?php
require __DIR__ . '/vendor/autoload.php';

const UNCHANGED = 0;
const ASCENDING = 1;
const DESCENDING = -1;

/** @var string[] $input */
$fileInput = file('testinput4.txt', FILE_IGNORE_NEW_LINES);
$input = [];
foreach ($fileInput as $line) {
    $input[] = str_split($line);
}
$lineCount = count($input);
$charCount = count($input[0]);
$total = 0;

foreach ($input as $lineIndex => $line) {
    foreach ($line as $charIndex => $char) {
        if ($char !== 'X') {
            continue;
        }
        if ($charIndex >= 3) {
            // West
            if (wordFound($input, $lineIndex, $charIndex, DESCENDING, UNCHANGED)) {
                $total++;
            }
            if ($lineIndex >= 3) {
                // North West
                if (wordFound($input, $lineIndex, $charIndex, DESCENDING, DESCENDING)) {
                    $total++;
                }
            }
            if ($lineCount - $lineIndex >= 3) {
                // South West
                if (wordFound($input, $lineIndex, $charIndex, DESCENDING, ASCENDING)) {
                    $total++;
                }
            }
        }
        if ($lineIndex >= 3) {
            // North
            if (wordFound($input, $lineIndex, $charIndex, UNCHANGED, DESCENDING)) {
                $total++;
            }
            if ($charCount - $charIndex >= 3) {
                // North East
                if (wordFound($input, $lineIndex, $charIndex, ASCENDING, DESCENDING)) {
                    $total++;
                }
            }
        }
        if ($charCount - $charIndex >= 3) {
            // East
            if (wordFound($input, $lineIndex, $charIndex, ASCENDING, UNCHANGED)) {
                $total++;
            }
            if ($lineCount - $lineIndex >= 3) {
                // South East
                if (wordFound($input, $lineIndex, $charIndex, ASCENDING, ASCENDING)) {
                    $total++;
                }
            }
        }
    }
}

function wordFound(array $input, int $line, int $char, int $charDirection, int $lineDirection): bool
{
    $word = ['X', 'M', 'A', 'S'];
    for ($i = 1; $i <= 3; $i++) {
        $char += $charDirection;
        $line += $lineDirection;
        echo $charDirection . ' ' . $lineDirection . ' ' . $char . ' ' . $line . PHP_EOL;
        if ($input[$line][$char] !== $word[$i]) {
            return false;
        }
    }
    return true;
}

echo $total;