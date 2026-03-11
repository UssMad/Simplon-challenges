<?php 
    session_start();

    if (isset($_POST["username"])) {
        $_SESSION["username"] = $_POST["username"];
        if (!empty($_POST["username"])) {
            header("location: Challenge 8 next session.php");
        } else {
            echo "<h2>Please enter your username</h2>";
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<h1>Welcome Dear user</h1>
<body>
    <form method="post">
        Username:<br>  
        <input type="text" name="username" placeholder="Enter your username"><br><br>
        <button type="submit">Submit</button>
    </form>
</body>
</html>