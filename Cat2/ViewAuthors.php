<?php
// ViewAuthors.php

// Include the file with your database connection details
require_once "../configs/constants.php";

try {
    // Create connection using PDO
    $conn = new PDO("mysql:host=$hostname;dbname=$dbname", $username, $userpass);

    // Set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Prepare the SQL statement to select all authors in ascending order by AuthorFullName
    $stmt = $conn->prepare("SELECT * FROM authorstb ORDER BY author_full_name asc");

    // Execute the statement
    $stmt->execute();

    // Fetch all rows
    $authors = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Close the connection
    $conn = null;
} catch (PDOException $e) {
    // Handle database errors
    echo "Error: " . $e->getMessage();
    // You might want to log the error or handle it in some way appropriate for your application
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>We Write- View Author</title>
    <link rel="stylesheet" href="css/style.css" />
</head>

<body>

    <h2>View Authors</h2>

    <table>
        <tr>
            <th>Author Fullname</th>
            <th>Email</th>
            <th>Address</th>
            <th>Biography</th>
            <th>Date of Birth</th>
            <th>Suspended</th>
            <!-- Add more columns as needed -->
        </tr>
        <?php foreach ($authors as $author) : ?>
            <tr>
                <td><?php echo isset($author['author_full_name']) ? $author['author_full_name'] : 'N/A'; ?></td>
                <td><?php echo isset($author['author_email']) ? $author['author_email'] : 'N/A'; ?></td>
                <td><?php echo isset($author['author_address']) ? $author['author_address'] : 'N/A'; ?></td>
                <td><?php echo isset($author['author_biography']) ? $author['author_biography'] : 'N/A'; ?></td>
                <td><?php echo isset($author['author_date_of_birth']) ? $author['author_date_of_birth'] : 'N/A'; ?></td>
                <td><?php echo isset($author['author_suspended']) ? ($author['author_suspended'] ? 'Yes' : 'No') : 'N/A'; ?></td>
            </tr>
        <?php endforeach; ?>
    </table>


</body>

</html>

</body>

</html>