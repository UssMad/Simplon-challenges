<?php

$friends = [ 
    "Abdo"=> 50,
    "Hassan"=> 110, 
    "Hussien"=> 120, 
    "Husni"=> 80, 
    "Mohsin"=> 90 
];
foreach ($friends as $name => $amount) {
    if ( $amount >= 100) {
    echo "This guy owes more than 100 DH: " . $name . "\n";
    }
}

?>