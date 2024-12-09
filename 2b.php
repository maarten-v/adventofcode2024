<?php

/** @var string[] $input */
$input = file('testinput2.txt');
$safeLines = 0;
foreach ($input as $line) {
    echo '---' . PHP_EOL;
    $levels = explode(' ', str_replace("\n", '' , $line));
    $previousLevel = null;
    $ascOrDesc = null;
    $levelCounter = 0;
    $levelRemoved = false;
    foreach ($levels as $level) {
        $levelCounter++;
        echo 'levels: ' . $previousLevel . ' ' . $level.  ' ' . $ascOrDesc.  PHP_EOL;
        echo 'counter ' . $levelCounter . PHP_EOL;
        $thisLevelWasRemoved = false;
        if (is_null($previousLevel)) {
            $previousLevel = $level;
            //echo 'c1'. PHP_EOL;
            continue;
        }
        if (is_null($ascOrDesc)) {
            if ($level > $previousLevel) {
                $ascOrDesc = 'asc';
            } elseif ($level < $previousLevel) {
                $ascOrDesc = 'desc';
            } else {
                echo $line . PHP_EOL;
                echo '1' . PHP_EOL;
                removeLevel($levelRemoved, $thisLevelWasRemoved);
            }
        } elseif (($ascOrDesc === 'asc' && $level < $previousLevel) ||
            ($ascOrDesc === 'desc' && $level > $previousLevel)) {
            if ($levelCounter === 3) {
                echo 'switchitng' . PHP_EOL;
                //if ($ascOrDesc === 'asc') {
                //    $ascOrDesc = 'desc';
                //} else {
                //    $ascOrDesc = 'asc';
                //}
                $ascOrDesc = null;
            } elseif ($levelRemoved) {
                echo $line . PHP_EOL;
                echo 'c2'. PHP_EOL;
                continue 2;
            }
            echo $line . PHP_EOL;
            echo '2' . ' ' . $previousLevel . ' ' . $level . PHP_EOL;
            removeLevel($levelRemoved, $thisLevelWasRemoved);
        }
        if (abs($previousLevel - $level) > 3 || $previousLevel === $level) {
            if ($levelRemoved) {
                echo $line . PHP_EOL;
                echo 'c3'. PHP_EOL;
                continue 2;
            }
            //echo $line . PHP_EOL;
            //echo '3' . PHP_EOL;
            removeLevel($levelRemoved, $thisLevelWasRemoved);
        }

        if (!$thisLevelWasRemoved) {
            //echo 'setting level' . PHP_EOL;
            $previousLevel = $level;
        }
    }
    echo 'safe' . PHP_EOL;
    $safeLines++;
}

function removeLevel(&$levelRemoved, &$thisLevelWasRemoved): void
{
    $levelRemoved = true;
    $thisLevelWasRemoved = true;
}

echo $safeLines;