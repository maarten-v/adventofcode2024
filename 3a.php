<?php

/** @var string[] $input */
$input = file('input3.txt');
$total = 0;
foreach ($input as $line) {
    preg_match_all('/mul\((\d*),(\d*)\)/', $line, $matches);
    foreach ($matches[1] as $index => $match) {
        $total += $match * $matches[2][$index];
    }
}

echo $total;