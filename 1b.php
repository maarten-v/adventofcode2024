<?php

/** @var string[] $input */
$input = file('input1.txt');
$total = 0;
$counts = [];
foreach ($input as $line) {
    $numbers = explode('   ', str_replace("\n", '' , $line));
    $a[] = $numbers[0];
    if (!isset($counts[$numbers[1]])) {
        $counts[$numbers[1]] = 0;
    }
    $counts[$numbers[1]]++;
}
foreach ($a as $inputA) {
    $total += $inputA * ($counts[$inputA] ?? 0);
}
echo $total;