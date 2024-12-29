<?php
require __DIR__ . '/vendor/autoload.php';

/** @var string[] $input */
$input = file('testinput3.txt');
$total = 0;
foreach ($input as $line) {
    preg_match_all('/do\(\)\s*(.*?)\s*don\'t\(\)/', $line, $matches);
    $matchCount = count($matches[1]);
    for ($i = 0; $i < $matchCount; $i++) {
        $total += getAmountFromString($matches[1][$i]);
    }
    $firstDoPosition = strpos($line, 'do()');
    $firstDontPosition = strpos($line, 'don\'t()');
    $stopPosition = min($firstDontPosition, $firstDoPosition);
    $begin = substr($line, 0, $stopPosition);
    $total += getAmountFromString($begin);
    $lastDoPosition = strrpos($line, 'do()');
    $lastDontPosition = strrpos($line, 'don\'t()');
    if ($lastDontPosition > $lastDoPosition) {
        continue;
    }
    $textAfterLastStart = substr($line, $lastDoPosition + 2);
    $total += getAmountFromString($textAfterLastStart);
    echo '----' . PHP_EOL;
}

function getAmountFromString(string $matches): int
{
    $amount = 0;
    preg_match_all('/mul\((\d*),(\d*)\)/', $matches, $subMatches);
    $subMatchCount = count($subMatches[0]);
    for ($j = 0; $j < $subMatchCount; $j++) {
        echo $subMatches[1][$j] . ' ' . $subMatches[2][$j] . PHP_EOL;
        $amount += $subMatches[1][$j] * $subMatches[2][$j];
    }
    return $amount;
}

echo $total;