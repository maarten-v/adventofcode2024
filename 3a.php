<?php

/** @var string[] $input */
$input = file('input3.txt');
$total = 0;
foreach ($input as $line) {
    preg_match_all('/mul\((\d*),(\d*)\)/', $line, $matches);
    $matchCount = count($matches[0]);
    for ($i = 0; $i < $matchCount; $i++) {
        $total += $matches[1][$i] * $matches[2][$i];
    }
}

echo $total;