<?php
require __DIR__ . '/vendor/autoload.php';

/** @var string[] $input */
$input = file('input3.txt');
$total = 0;
foreach ($input as $line) {
    preg_match_all('/do\(\)\s*(.*?)\s*don\'t\(\)/', $line, $matches);
    $matchCount = count($matches[1]);
    ray($matches);
    for ($i = 0; $i < $matchCount; $i++) {
        preg_match_all('/mul\((\d*),(\d*)\)/', $matches[1][$i], $subMatches);
        $subMatchCount = count($subMatches[0]);
        for ($j = 0; $j < $subMatchCount; $j++) {
            echo 'sub ' . $subMatches[1][$j] . ' ' . $subMatches[2][$j] . PHP_EOL;
            $total += $subMatches[1][$j] * $subMatches[2][$j];
        }
    }
    $stopPosition = strpos($line, 'don');
    $begin = substr($line, 0, $stopPosition);
    // add check if there's a do before don't
    ray($begin);
    preg_match_all('/mul\((\d*),(\d*)\)/', $begin, $beginMatches);

    ray($beginMatches);
    echo 'begin ' . $beginMatches[1][0] . ' ' . $beginMatches[2][0] . PHP_EOL;
    $total += $beginMatches[1][$i] * $beginMatches[2][$i];
    $lastDo = strrpos($line, 'do()');
    $textAfterLastStart = substr($line, $lastDo + 2);
    preg_match_all('/mul\((\d*),(\d*)\)/', $textAfterLastStart, $endMatches);
    echo 'end ' . $endMatches[1][0] . ' ' . $endMatches[2][0] . PHP_EOL;
    $total += $endMatches[1][$i] * $endMatches[2][$i];
    exit();
}

echo $total;