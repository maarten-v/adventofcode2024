<?php

require __DIR__ . '/vendor/autoload.php';

/** @var string[] $input */
$fileInput = file('input9.txt', FILE_IGNORE_NEW_LINES);
$input = str_split($fileInput[0]);

$counter = 0;
$mode = 'files';
$files = [];
$spaces = [];
foreach ($input as $char) {
    if ($mode === 'files') {
        $files[] = ['name' => $counter, 'length' => (int) $char];
        $counter++;
    } else {
        $spaces[] = (int) $char;
    }
    $mode = $mode === 'files' ? 'free' : 'files';
}

$outputArray = [];
moveFirstFileToOutput();
while (count($spaces) > 0 && count($files) > 0) {
    if ($spaces[0] > max($files)['length']) {
        $outputArray[] = max($files);
        $spaces[0] -= max($files)['length'];
        array_pop($files);

        continue;
    }
    $outputArray[] = ['name' => max($files)['name'], 'length' => $spaces[0]];
    $files[array_key_last($files)]['length'] -= $spaces[0];
    unset($spaces[0]);
    $spaces = array_values($spaces);
    moveFirstFileToOutput();
}

$result = 0;
$counter = 0;
foreach ($outputArray as $output) {
    for ($i = 0; $i < $output['length']; $i++) {
        $result += $counter * $output['name'];
        $counter++;
    }
}

function moveFirstFileToOutput(): void
{
    global $files, $outputArray;
    $outputArray[] = $files[0];
    unset($files[0]);
    $files = array_values($files);
}

echo $result;
