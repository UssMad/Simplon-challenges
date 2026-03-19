<?php

require ("db.php");

$title = "Harry Potter and the Sorcerer's Stone";
$author = "J.K. Rowling";
$price = 12;

$sql = "INSERT INTO library_books (Title, Author, Price) VALUES (:Title, :Author, :Price)";
$stmt = $pdo->prepare($sql);
$stmt-> execute(["Title" => $title, "Author" => $author, "Price" => $price]);
?>