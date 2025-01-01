<?php

/** @var string[] $input */
$input = file('input1.txt');
foreach ($input as $line) {
    $numbers = explode('   ', $line);
    $a[] = $numbers[0];
    $b[] = $numbers[1];
}
sort($a);
sort($b);

$diffs = 0;
foreach ($a as $index => $currentA) {
    $diffs += abs($currentA - $b[$index]);
}
echo $diffs;