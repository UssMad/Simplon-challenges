<?php
    session_start();
    if (isset($_POST["favoritepl"])) {
        $_SESSION["favoritepl"] = $_POST["favoritepl"];
        if (!empty($_POST["favoritepl"])) {
            header("location: Challenge 8 thirdpage.php");
        } else {
            $error = "<h2><span style='color: red;'>Please enter your favorite programming language</span></h2>";
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
<body>
    <h1>What is your favorite programming language?</h1>
    <form method="post">
        Favorite Programming Language:<br>
        <textarea name="favoritepl" placeholder="Enter your favorite programming language"></textarea><br><br>
        <button type="submit">Submit</button>
    </form>
</body>
<?php
    if (isset($error)) {
        echo $error;
    }
    ?>
</html>