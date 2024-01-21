<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <title>Login</title>
        <link rel="stylesheet" href="main.css" />
    </head>
    <body>
        <form method="post" action="signup.php">
            <h1>Signup</h1>
            <div class="textBoxdiv">
                <input type="text" id="signup_username" placeholder="Username" name="signup_username" required/>
            </div>
            <div class="textBoxdiv">
                <input type="password" id="signup_password" placeholder="Password" name="signup_password" required/>
            </div>
            <input type="submit" value="Signup" class="loginBtn" />
            <div class="signup">
                Already have an account ? <br />
                <a href="login.php">Back to login</a>
            </div>
        </form>
    </body>
</html>

<?php
// signup.php

// Start session
session_start();

//define PDO - tell about the database file
$db = new PDO('sqlite:database.db');   

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['signup_username'];
    $password = $_POST['signup_password'];

    // Check if the username already exists
    $checkStmt = $db->prepare('SELECT * FROM users WHERE username = ?');
    $checkStmt->execute([$username]);
    $existingUser = $checkStmt->fetch(PDO::FETCH_ASSOC);

    if ($existingUser) {
        echo "Signup failed. Username already exists.";
    } else {
        // Insert the new user into the database
        $insertStmt = $db->prepare('INSERT INTO users (username, password) VALUES (?, ?)');
        $insertStmt->execute([$username, $password]);

        echo "Signup successful. Welcome, $username!";
    }
}
?>