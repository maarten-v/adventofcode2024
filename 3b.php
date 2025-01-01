<?php
require __DIR__ . '/vendor/autoload.php';

/** @var string[] $input */
$input = file('input3.txt', FILE_IGNORE_NEW_LINES);
$line = implode('', $input);
$total = 0;

$firstDoPosition = strpos($line, 'do()');
$firstDontPosition = strpos($line, 'don\'t()');
$stopPosition = min($firstDontPosition, $firstDoPosition);
$begin = substr($line, 0, $stopPosition);
$total += getAmountFromString($begin);

preg_match_all('/do\(\)\s*(.*?)\s*don\'t\(\)/', $line, $matches);
foreach ($matches[1] as $match) {
    $total += getAmountFromString($match);
}

$lastDoPosition = strrpos($line, 'do()');
$lastDontPosition = strrpos($line, 'don\'t()');
if ($lastDontPosition <= $lastDoPosition) {
    $textAfterLastStart = substr($line, $lastDoPosition + 2);
    $total += getAmountFromString($textAfterLastStart);
}

function getAmountFromString(string $matches): int
{
    $amount = 0;
    preg_match_all('/mul\((\d*),(\d*)\)/', $matches, $subMatches);
    foreach ($subMatches[1] as $index => $match) {
        $amount += $match * $subMatches[2][$index];
    }

    return $amount;
}

echo $total;