<?php
require __DIR__ . '/vendor/autoload.php';

/** @var string[] $input */
$fileInput = file('input4.txt', FILE_IGNORE_NEW_LINES);
$input = [];
foreach ($fileInput as $line) {
    $input[] = str_split($line);
}
$total = 0;
$lineCount = count($input);
$charCount = count($input[0]);
foreach ($input as $lineIndex => $line) {
    foreach ($line as $charIndex => $char) {
        if ($char !== 'A' || $charIndex < 1 || $lineIndex < 1 || $charCount - $charIndex < 2 || $lineCount - $lineIndex < 2 ) {
            continue;
        }
        if (
            (
                ($input[$lineIndex - 1][$charIndex - 1] === 'M' && $input[$lineIndex + 1][$charIndex + 1] === 'S') ||
                ($input[$lineIndex - 1][$charIndex - 1] === 'S' && $input[$lineIndex + 1][$charIndex + 1] === 'M')
            ) &&
            (
                ($input[$lineIndex - 1][$charIndex + 1] === 'M' && $input[$lineIndex + 1][$charIndex - 1] === 'S') ||
                ($input[$lineIndex - 1][$charIndex + 1] === 'S' && $input[$lineIndex + 1][$charIndex - 1] === 'M')
            )
        ) {
            $total++;
        }
    }
}

echo $total;