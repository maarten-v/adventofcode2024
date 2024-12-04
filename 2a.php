<?php

/** @var string[] $input */
$input = file('testinput2.txt');
$safeLines = 0;
foreach ($input as $line) {
    $levels = explode(' ', str_replace("\n", '' , $line));

}

echo $safeLines;