<?php

require __DIR__ . '/vendor/autoload.php';

/** @var string[] $input */
$input = file('testinput7.txt', FILE_IGNORE_NEW_LINES);

foreach ($input as $line) {
    [$result, $numbersArray] = explode(': ', $line);
    $numbers = explode(' ', $numbersArray);

}