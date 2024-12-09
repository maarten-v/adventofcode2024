<?php

/** @var string[] $input */
$input = file('input2.txt');
$safeLines = 0;
foreach ($input as $line) {
    $levels = explode(' ', str_replace("\n", '' , $line));
    $previousLevel = null;
    $ascOrDesc = null;
    foreach ($levels as $level) {
        if (is_null($previousLevel)) {
            $previousLevel = $level;
            continue;
        }
        if (is_null($ascOrDesc)) {
            if ($level > $previousLevel) {
                $ascOrDesc = 'asc';
            } elseif ($level < $previousLevel) {
                $ascOrDesc = 'desc';
            } else {
                continue 2;
            }
        } elseif (($ascOrDesc === 'asc' && $level <= $previousLevel) ||
            ($ascOrDesc === 'desc' && $level >= $previousLevel)) {
            continue 2;
        }
        if (abs($previousLevel - $level) > 3) {
            continue 2;
        }
        $previousLevel = $level;
    }
    $safeLines++;
}

echo $safeLines;