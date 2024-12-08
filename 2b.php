<?php

/** @var string[] $input */
$input = file('testinput2.txt');
$safeLines = 0;
foreach ($input as $line) {
    $levels = explode(' ', str_replace("\n", '' , $line));
    $previousLevel = null;
    $ascOrDesc = null;
    $levelCounter = 0;
    $levelRemoved = false;
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
                $levelRemoved = true;
            }
        }
        if (($ascOrDesc === 'asc' && $level <= $previousLevel) ||
            ($ascOrDesc === 'desc' && $level >= $previousLevel)) {
            if ($levelCounter === 1) {
                if ($ascOrDesc === 'asc') {
                    $ascOrDesc = 'desc';
                } else {
                    $ascOrDesc = 'asc';
                }
                $levelRemoved = true;
            } else {
                if ($levelRemoved) {
                    continue 2;
                }
                $levelRemoved = true;
            }
        }
        if (abs($previousLevel - $level) > 3) {
            if ($levelRemoved) {
                continue 2;
            }
            $levelRemoved = true;
        }
        $levelCounter++;
        $previousLevel = $level;
    }
    echo $line . PHP_EOL;
    $safeLines++;
}

echo $safeLines;