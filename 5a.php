<?php
require __DIR__ . '/vendor/autoload.php';

/** @var string[] $input */
$input = file('input5.txt', FILE_IGNORE_NEW_LINES);
$parsingUpdates = false;
$rules = [];
$updates = [];
foreach ($input as $line) {
    if (!$line) {
        $parsingUpdates = true;
        continue;
    }
    if ($parsingUpdates) {
        $updates[] = explode(',', $line);
        continue;
    }
    $rules[] = explode('|', $line);
}

$total = 0;
foreach ($updates as $updateIndex => $update) {
    if (!isUpdateValid($update, $rules)) {
        continue;
    }
    $total += $update[(count($update) / 2) - 0.5];
}

function isUpdateValid(mixed $update, array $rules): bool
{
    foreach ($update as $pageIndex => $page) {
        if ($pageIndex === 0) {
            continue;
        }
        foreach ($rules as $rule) {
            if ($rule[0] !== $page) {
                continue;
            }
            for ($i = 0; $i < $pageIndex; $i++) {
                if ($update[$i] === $rule[1]) {
                    return false;
                }
            }
        }
    }

    return true;
}

echo $total;