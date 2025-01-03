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
    $correctedUpdate = correctUpdate($update, $rules);
    if ($correctedUpdate === $update) {
        continue;
    }
    $total += $correctedUpdate[(count($correctedUpdate) / 2) - 0.5];
}

function correctUpdate(mixed $update, array $rules): array
{
    $previousState = $update;
    while (true) {
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
                        array_splice($update, $pageIndex + 1, 0, $update[$i]);
                        unset($update[$i]);
                        $update = array_values($update);
                    }
                }
            }
        }
        // if nothing was changed / fixed, we're finished with reordering
        if ($previousState === $update) {
            return $update;
        }
        $previousState = $update;
    }
}

echo $total;