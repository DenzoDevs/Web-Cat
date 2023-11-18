<?php
// AutRegistration.php

// Include the file with your database connection details
require_once "../configs/constants.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    try {
        // Create connection using PDO
        $conn = new PDO("mysql:host=$hostname;dbname=$dbname", $username, $userpass);

        // Set the PDO error mode to exception
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Prepare the SQL statement to insert data into the database
        $stmt = $conn->prepare("INSERT INTO  (author_full_name, author_email, author_address, author_biography, author_date_of_birth, author_suspended) VALUES (:author_full_name, :author_email, :author_address, :author_biography, :author_date_of_birth, :author_suspended)");

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
    } catch (PDOException $e) {
        // Handle database errors
        echo "Error: " . $e->getMessage();
        // You might want to log the error or handle it in some way appropriate for your application
    }
}
