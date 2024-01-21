<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Item List</title>
</head>
<body>
    <h1>Item List</h1>
    <ul>
        <?php
         //define PDO - tell about the database file
        $db = new PDO('sqlite:database.db');        

        $result = $db->query('SELECT * FROM items');

        $row = $result->fetchAll(PDO::FETCH_ASSOC);
        
        while ($row = $result->fetchAll()) {
            echo '<li>' . $row['name'] . ' - ' . $row['description'] . '</li>';
        }
        ?>
    </ul>
    <a href="add_item.php" class="add-button">Add to database</a>
</body>
</html>

<?php 
// Start session
session_start();

// db.php - Database connection configuration
$dbFile = __DIR__ . '/database.db';
$dsn = 'sqlite:' . $dbFile;
$pdo = new PDO($dsn);

// Display logout button if the user is logged in
if (isset($_SESSION['username'])) {
    echo "Welcome, {$_SESSION['username']}! <a href='logout.php'>Logout</a><br>";
} else {
    // Redirect to login page
    header('Location: login.php');
}