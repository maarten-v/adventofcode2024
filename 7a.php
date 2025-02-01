<?php

require __DIR__ . '/vendor/autoload.php';

/** @var string[] $input */
$input = file('input7.txt', FILE_IGNORE_NEW_LINES);

$total = 0;
foreach ($input as $line) {
    [$resultAsString, $numbersArray] = explode(': ', $line);
    $result = (int) $resultAsString;
    $numbersAsString = explode(' ', $numbersArray);
    $numbers = array_map('intval', $numbersAsString);
    if (checkCalculation($result, 0, $numbers)) {
        $total+= $result;
    }
}

function checkCalculation(int $result, int $leftSideOfCalculation, array $numbers): bool
{
    if (count($numbers) === 1) {
        return $leftSideOfCalculation + $numbers[0] === $result || $leftSideOfCalculation * $numbers[0] === $result;
    }
    $operators = ['+', '*'];

    foreach ($operators as $operator) {
        if ($operator === '+') {
            $newLeftSideOfCalculation = $leftSideOfCalculation + $numbers[0];
        } elseif ($operator === '*') {
            $newLeftSideOfCalculation = $leftSideOfCalculation * $numbers[0];
        }
        $cloneNumbers = $numbers;
        array_shift($cloneNumbers);
        if (checkCalculation($result, $newLeftSideOfCalculation, $cloneNumbers)) {
            return true;
        }
    }
    return false;
}

echo $total;