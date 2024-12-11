<?php

/** @var string[] $input */
$input = file('input2.txt');
$safeLines = 0;
foreach ($input as $line) {
    $levels = explode(' ', str_replace("\n", '' , $line));
    if (isReportValid($levels)) {
        $safeLines++;
    }
}

function isReportValid(array $levels): bool
{
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
                return false;
            }
        } elseif (($ascOrDesc === 'asc' && $level <= $previousLevel) ||
            ($ascOrDesc === 'desc' && $level >= $previousLevel)) {
            return false;
        }
        if (abs($previousLevel - $level) > 3) {
            return false;
        }
        $previousLevel = $level;
    }
    return true;
}

echo $safeLines;