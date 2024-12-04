<?php

/** @var string[] $input */
$input = file('input1.txt');
foreach ($input as $line) {
    $numbers = explode('   ', str_replace("\n", '' , $line));
    $a[] = $numbers[0];
    $b[] = $numbers[1];
}
$count = count($a);
sort($a);
sort($b);

$diffs = 0;
for ($i = 0; $i < $count; $i++) {
    $diffs += abs($a[$i] - $b[$i]);
}
echo $diffs;