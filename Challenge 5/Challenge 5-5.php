<?php

function manualReverse($text) {

    $reversed = "";
    $length = strlen($text);

    for ($i = $length - 1; $i >= 0; $i--) {
        $reversed .= $text[$i];
    }

    return $reversed;
}


echo manualReverse("hello");

?>