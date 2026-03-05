<?php 


$TEA_CUPS = 6;
$TEA_COST = 5;
$STUDENT = true;

$TEA_BELL = $TEA_COST * $TEA_CUPS;

// Discount if more than 5 teas
if ($TEA_CUPS > 5) {
$TEA_BELL -= $TEA_CUPS * 1;
}

// 20% student discount
if ($STUDENT == true) {
$TEA_BELL *= 0.8;
}

echo "The price is " . $TEA_BELL . " DH.";

?>