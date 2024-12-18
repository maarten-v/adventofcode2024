<?php

/** @var string[] $input */
$input = file('testinput3.txt');
$total = 0;
foreach ($input as $line) {
    preg_match_all('/do(?!n\'t)\s*(.*?)\s*don\'t/', $line, $matches);
    $matchCount = count($matches[0]);
    for ($i = 0; $i < $matchCount; $i++) {
        preg_match_all('/mul\((\d*),(\d*)\)/', $line, $submatches);
        $total += $submatches[1][$i] * $submatches[2][$i];
    }
}

echo $total;