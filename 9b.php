<?php

require __DIR__ . '/vendor/autoload.php';

/** @var string[] $input */
$fileInput = file('input9.txt', FILE_IGNORE_NEW_LINES);
$input = str_split($fileInput[0]);

$numberOfLines = 0;
$mode = 'files';
$spaces = [];
foreach ($input as $char) {
    if ($mode === 'files') {
        $spaces[] = ['name' => $numberOfLines, 'length' => (int) $char, 'type' => 'file'];
        $numberOfLines++;
    } else {
        $spaces[] = ['name' => null, 'length' => (int) $char, 'type' => 'free'];
    }
    $mode = $mode === 'files' ? 'free' : 'files';
}

for ($i = ($numberOfLines - 1); $i > 0; $i--) {
    $arrayKeyItemToMove = array_find_key($spaces, static fn ($item) => $item['name'] === $i);
    for ($j = 0; $j < $arrayKeyItemToMove; $j++) {
        if ($spaces[$j]['type'] === 'file') {
            continue;
        }
        if ($spaces[$j]['length'] >= $spaces[$arrayKeyItemToMove]['length']) {
            $space = $spaces[$arrayKeyItemToMove];
            $spaces[$arrayKeyItemToMove] = [
                'name' => null,
                'length' => $space['length'],
                'type' => 'free',
            ];
            $spaces[$j]['length'] -= $space['length'];
            array_splice($spaces, $j, 0, [$space]);
            continue 2;
        }
    }
}

$result = 0;
$counter = 0;
foreach ($spaces as $output) {
    for ($i = 0; $i < $output['length']; $i++) {
        if ($output['type'] === 'file') {
            $result += $counter * $output['name'];
        }
        $counter++;
    }
}

echo $result;
