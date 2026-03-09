<?php

function multiplyNumbers($a, $b) {
    if (is_int($a) && is_int($b)) {
        return $a * $b;
    } else {
        return "Error: Invalid Input";
    }
}
echo multiplyNumbers(5, 10) . "\n";
echo multiplyNumbers(5,"apple");
?>