<?php

$count = 0;
$i = 1;

while ($i <= 50) {

    if ($i % 2 == 0) {
        $count++;
    }

    $i++;
}

echo "Total even numbers: " . $count;
?>