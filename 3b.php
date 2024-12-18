<?php

/** @var string[] $input */
$input = file('testinput3.txt');
$total = 0;
foreach ($input as $line) {
    preg_match_all('/do(?!n\'t)\s*(.*?)\s*don\'t/', $line, $matches);
    $matchCount = count($matches[0]);
    for ($i = 0; $i < $matchCount; $i++) {
        preg_match_all('/mul\((\d*),(\d*)\)/', $line, $submatches);
        $total += $submatches[1][$i] * $submatches[2][$i];
    }
    $begin = strtok($line, 'don\'t');
    preg_match_all('/mul\((\d*),(\d*)\)/', $begin, $beginMatches);
    $total += $beginMatches[1][$i] * $beginMatches[2][$i];
    $lastDo = strrpos($line, 'do');
    $textAfterLastDo = substr($line, $lastDo + 2, 3);
    if ($textAfterLastDo !== 'n\'t') {
        $textAfterLastStart = substr($line, $lastDo + 2);
        preg_match_all('/mul\((\d*),(\d*)\)/', $begin, $endMatches);
        var
        $total += $endMatches[1][$i] * $endMatches[2][$i];
    }
}

echo $total;