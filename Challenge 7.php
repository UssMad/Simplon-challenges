<?php

$name = "";
$email = "";
$message = "";
$error = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $name = $_POST['name'];
    $email = $_POST['email'];
    $message = $_POST['message'];

    // email validation
    if (strpos($email, "@") === false) {
        $error = "Email must contain @";
    } else {
        echo "<h3>Form submitted successfully</h3>";
        echo "Name: " . $name . "<br>";
        echo "Email: " . $email . "<br>";
        echo "Message: " . $message . "<br>";
    }

}

?>

<!DOCTYPE html>
<html>
<head>
<title>Contact Form</title>
</head>

<body>

<h2>Contact Form</h2>

<?php
if ($error) {
    echo "<p style='color:red;'>$error</p>";
}
?>

<form method="POST">

Name:<br>
<input type="text" name="name" value="<?php echo $name; ?>"><br><br>

Email:<br>
<input type="text" name="email" value="<?php echo $email; ?>"><br><br>

Message:<br>
<textarea name="message"><?php echo $message; ?></textarea><br><br>

<button type="submit">Send</button>

</form>

</body>
</html>