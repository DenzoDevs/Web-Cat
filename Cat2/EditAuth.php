<?php
// EditAuth.php

// Include the file with your database connection details

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['authorId'])) {
    require_once "configs/constants.";

    try {
        // Create connection using PDO
        $conn = new PDO("mysql:host=$hostname;dbname=$dbname", $username, $userpass);

        // Set the PDO error mode to exception
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Prepare the SQL statement to select details of the selected author
        $stmt = $conn->prepare("SELECT * FROM authortb WHERE author_id = :author_id");

        // Bind parameters
        $stmt->bindParam(':authorId', $_GET['author_id']);

        // Execute the statement
        $stmt->execute();

        // Fetch the author details
        $author = $stmt->fetch(PDO::FETCH_ASSOC);

        // Close the connection
        $conn = null;
    } catch (PDOException $e) {
        // Handle database errors
        echo "Error: " . $e->getMessage();
        // You might want to log the error or handle it in some way appropriate for your application
    }
}

// Process form submission for editing author details
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['editAuthor'])) {
    try {
        // Create connection using PDO
        $conn = new PDO("mysql:host=$hostname;dbname=$dbname", $username, $userpass);

        // Set the PDO error mode to exception
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Prepare the SQL statement to update author details
        $stmt = $conn->prepare("UPDATE authortb SET author_full_name = :author_full_name, author_email = :author_email, author_address = :author_address, author_biography = :author_biography, author_date_of_birth = :author_date_of_birth, author_suspended = :author_suspended WHERE author_id = :author_id");

        // Bind parameters
        $stmt->bindParam(':author_full_name', $_POST['author_full_name']);
        $stmt->bindParam(':author_email', $_POST['author_email']);
        $stmt->bindParam(':author_address', $_POST['author_address']);
        $stmt->bindParam(':autho_biography', $_POST['author_biography']);
        $stmt->bindParam(':author_date_of_birth', $_POST['author_date_of_birth']);

        // Check if the checkbox is checked
        $author_suspended = isset($_POST['author_suspended']) ? 1 : 0;
        $stmt->bindParam(':author_suspended', $author_suspended);

        // Execute the statement
        $stmt->execute();

        // Close the connection
        $conn = null;

        // Redirect to a success page or do something else
        header("Location: success.php");
        exit();
    } catch (PDOException $e) {
        // Handle database errors
        echo "Error: " . $e->getMessage();
        // You might want to log the error or handle it in some way appropriate for your application
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>We Write- Edit Author</title>
    <link rel="stylesheet" href="css/style.css" />
</head>

<body>

    <h2>Edit Author</h2>

    <?php if (isset($author)) : ?>
        <form action="EditAuth.php" method="POST">
            <input type="hidden" name="author_id" value="<?php echo $author['author_id']; ?>">

            <label for="author_full_name">Fullname:</label>
            <input type="text" name="author_full_name" value="<?php echo $author['author_full_name']; ?>" required><br>

            <label for="author_email">Email:</label>
            <input type="email" name="author_email" value="<?php echo $author['author_email']; ?>"><br>

            <label for="author_address">Address:</label>
            <input type="text" name="author_address" value="<?php echo $author['author_address']; ?>" required><br>

            <label for="author_biography">Biography:</label>
            <textarea name="author_biography" rows="4"><?php echo $author['author_biography']; ?></textarea><br>

            <label for="author_date_of_birth">Date of Birth:</label>
            <input type="date" name="author_date_of_birth" value="<?php echo $author['author_date_of_birth']; ?>" required><br>

            <label for="author_suspended">Suspended:</label>
            <input type="checkbox" name="author_suspended" <?php echo ($author['author_suspended'] == 1) ? 'checked' : ''; ?>><br>

            <input type="submit" name="editAuthor" value="Save Changes">
        </form>
    <?php else : ?>
        <p>No author selected for editing.</p>
    <?php endif; ?>

</body>

</html