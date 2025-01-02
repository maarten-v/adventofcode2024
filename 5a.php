<?php
require __DIR__ . '/vendor/autoload.php';

/** @var string[] $input */
$input = file('testinput5.txt', FILE_IGNORE_NEW_LINES);
$parsingUpdates = false;
$rules = [];
$updates = [];
foreach ($input as $line) {
    if (!$line) {
        $parsingUpdates = true;
        continue;
    }
    if ($parsingUpdates) {
        $updates[] = explode(',',$line);
        continue;
    }
    $rules[] = explode('|', $line);
}

foreach ($updates as $update) {
    foreach ($rules as $rule) {
        if (!in_array($rule))
    }
}