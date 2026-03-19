<?php 

include("db.php");

$minPrice = 10;
$sql="SELECT * FROM library_books WHERE Price > :Price";
$stmt = $conn->prepare($sql);
$stmt->execute(['Price' => $minPrice]);

$books = $stmt->fetchAll(PDO::FETCH_ASSOC);
foreach ($books as $book) {
    echo "Title: " . $book['Title'] . ", Price: " . $book['Price'] . "<br>";
}
?>


