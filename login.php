<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Login</title>
    <link rel="stylesheet" href="main.css" />
  </head>
  <body>
    <form method="post" action="login.php">
      <h1>Login</h1>
      <div class="textBoxdiv">
        <input type="text" id="login_username" placeholder="Username" name="login_username" required/>
      </div>
      <div class="textBoxdiv">
        <input type="password" id="login_password" placeholder="Password" name="login_password" required/>
      </div>
      <input type="submit" value="Login" class="loginBtn" />
      <div class="signup">
        Don't have an account ? <br />
        <a href="signup.php">Sign up</a>
      </div>
    </form>
  </body>
</html>

<?php
// login.php

// Start session
session_start();

//define PDO - tell about the database file
$db = new PDO('sqlite:database.db');   

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['login_username'];
    $password = $_POST['login_password'];

    $stmt = $db->prepare('SELECT * FROM users WHERE username = ? AND password = ?');
    $stmt->execute([$username, $password]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user) {
      // Set session variables
      $_SESSION['user_id'] = $user['id'];
      $_SESSION['username'] = $user['username'];
 
      //Login successful. Welcome, $username!";
      // Redirect to index.php
      header('Location: index.php');
    } else {
        echo "Login failed. Incorrect username or password.";
    }
}
?>