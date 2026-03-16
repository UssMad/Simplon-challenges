<?php 

$host = "localhost";
$dbname = "db";
$username = "root";
$password = "";     

try {
    $conn = mysqli_connect($host, $username, $password, $dbname);
    
} catch (mysqli_sql_exception ) {
    die("Connection failed: " . mysqli_connect_error());
}

if ($conn) {
    echo " Connected successfully";
}
?>