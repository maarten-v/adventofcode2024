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
$matchCount = count($matches[1]);
for ($i = 0; $i < $matchCount; $i++) {
    $total += getAmountFromString($matches[1][$i]);
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
    $subMatchCount = count($subMatches[0]);
    for ($j = 0; $j < $subMatchCount; $j++) {
        $amount += $subMatches[1][$j] * $subMatches[2][$j];
    }
    return $amount;
}

echo $total;