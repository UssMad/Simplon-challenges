<?php

$products = [
    ["name" => "Laptop", "category" => "tech"],
    ["name" => "Phone", "category" => "tech"],
    ["name" => "Tablet", "category" => "tech"],
    ["name" => "Chair", "category" => "office"],
    ["name" => "Desk", "category" => "office"]
];



$category = $_GET['category'] ?? null;


if ($category) {

    $filtered = [];

    foreach ($products as $product) {
        if ($product["category"] == $category) {
            $filtered[] = $product;
        }
    }

    $products = $filtered;
}


$sort = $_GET['sort'] ?? null;


if ($sort == "asc") {
    usort($products, function($a, $b) {
        return strcmp($a["name"], $b["name"]);
    });
}

if ($sort == "desc") {
    usort($products, function($a, $b) {
        return strcmp($b["name"], $a["name"]);
    });
}


foreach ($products as $product) {
    echo $product["name"] . " (" . $product["category"] . ")<br>";
}

?>