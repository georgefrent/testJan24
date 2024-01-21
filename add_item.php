<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Add Item</title>
</head>
<body>
    <h1>Add Item</h1>
    <form action="add_item.php" method="post">
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" required>
        <br>
        <label for="description">Description:</label>
        <textarea id="description" name="description" required></textarea>
        <br>
        <input type="submit" name="confirm" value="Confirm">
        <a href="index.php" class="cancel-button">Cancel</a>
    </form>
</body>
</html>
<?php
try {
    // Check if the form is submitted
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Handle form submission and insert data into the database
        $db = new PDO('sqlite:database.db');
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $name = isset($_POST['name']) ? $_POST['name'] : '';
        $description = isset($_POST['description']) ? $_POST['description'] : '';

        if (!empty($name) && !empty($description)) {
            $stmt = $db->prepare("INSERT INTO items (name, description) VALUES (:name, :description)");
            $stmt->bindParam(':name', $name);
            $stmt->bindParam(':description', $description);
            $stmt->execute();

            // Redirect back to the item list
            header('Location: index.php');
            
            exit;
        } else {
            // Handle validation errors or provide a message to the user
            echo 'Name and description are required.';
        }
    }
} catch (PDOException $e) {
    echo 'Error: ' . $e->getMessage();
}
?>