<?php
require __DIR__ . '/vendor/autoload.php';

/** @var string[] $input */
$input = file('testinput6.txt', FILE_IGNORE_NEW_LINES);

$map = [];
foreach ($input as $inputIndex => $line) {
    $map[] = str_split($line);
    $charPos = strpos($line, '^');
}

$outOfBounds = false;
while (!$outOfBounds) {

    $outOfBounds = true;
}