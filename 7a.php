<?php

require __DIR__ . '/vendor/autoload.php';

/** @var string[] $input */
$input = file('testinput7.txt', FILE_IGNORE_NEW_LINES);

$total = 0;
//foreach ($input as $line) {
//    [$resultAsString, $numbersArray] = explode(': ', $line);
//    $result = (int) $resultAsString;
//    $numbersAsString = explode(' ', $numbersArray);
//    $numbers = array_map('intval', $numbersAsString);
//    if (count($numbers) === 2) {
//        if ($numbers[0] + $numbers[1] === $result || $numbers[0] * $numbers[1] === $result) {
//            $total++;
//            continue;
//        }
//    }
//    $firstNumber = array_shift($numbers);
//    $operators = ['+', '*'];
//    foreach ($operators as $operator) {
//        checkCalculation($result, $firstNumber, $numbers);
//    }
//}

if (checkCalculation(190, 0, [1, 2 , 3])) {
    $total+= 190;
}
$counter = 0;
function checkCalculation($result, $firstNumber, $numbers): bool
{
    global $counter;
    $counter++;
    if ($counter === 15) {
        exit();
    }
    var_dump($firstNumber, $numbers);
    if (count($numbers) === 1) {
        dump('returning');
        return $firstNumber + $numbers[0] === $result || $firstNumber * $numbers[0] === $result;
    }
    $operators = ['+', '*'];

    //$newFirstNumber = array_shift($numbers);

    foreach ($operators as $operator) {
        if ($operator === '+') {
            $newFirstNumber = $firstNumber + $numbers[0];
            array_shift($numbers);
            var_dump($operator);
            if (checkCalculation($result, $newFirstNumber, $numbers)) {
                return true;
            }
        } elseif ($operator === '*') {
            $newFirstNumber = $firstNumber * $numbers[0];
            array_shift($numbers);
            if (checkCalculation($result, $newFirstNumber, $numbers)) {
                return true;
            }
        }
    }
    return false;
}

echo $total;