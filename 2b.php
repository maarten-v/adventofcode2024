<?php

/** @var string[] $input */
$input = file('input2.txt');
$safeLines = 0;
foreach ($input as $line) {
    $levels = explode(' ', $line);
    if (isReportValid($levels)) {
        $safeLines++;
    } elseif (isReportValidWithOneRemoved($levels)) {
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

function isReportValidWithOneRemoved(array $levels): bool
{
    foreach($levels as $index => $level) {
        $levelsWithOneRemoved = $levels;
        unset($levelsWithOneRemoved[$index]);
        if (isReportValid($levelsWithOneRemoved)) {
            return true;
        }
    }
    return false;
}

echo $safeLines;