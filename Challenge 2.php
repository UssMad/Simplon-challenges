<?php

$age = 17;

if ($age<12) {
    echo "The price is 20 DH. \n";
    echo "Special: Children's Menu included!." . "\n";
} else if ($age >=12 && $age<=18) {
    echo "The price is 40 DH." . "\n" ;

}  else if ($age > 60) {
    echo "The price is 30 DH. (Senior discount)" . "\n";
} else {

    echo "The price is 60 DH." . "\n";
}

?>