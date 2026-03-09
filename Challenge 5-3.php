<?php

function isAdult($age) {
    if ($age >=18) {
        return true;
    } else {
        return false;
    }
}
echo isAdult(18) ? "You are an adult." : "You are not an adult.";
?>