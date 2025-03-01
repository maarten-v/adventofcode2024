<?php

require __DIR__ . '/vendor/autoload.php';

/** @var string[] $input */
$fileInput = file('testinput9.txt', FILE_IGNORE_NEW_LINES);
$input = str_split($fileInput[0]);

$counter = 0;
$mode = 'files';
$output = '';
foreach ($input as $char) {
    if ($mode === 'files') {
        foreach (range(1, $char) as $i) {
            $output .= $counter;
        }
        $counter++;
    } else {

    }
    $mode = $mode === 'files' ? 'free' : 'files';
}

echo $output;