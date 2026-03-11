<?php

    session_start();
    echo "<h1>Welcome " . $_SESSION["username"] . "</h1>" . "<br>" . "<h2>Your favorite programming language is: " . $_SESSION["favoritepl"] . "</h2>";


?>