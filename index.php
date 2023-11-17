<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Web Cat</title>
    <link rel="stylesheet" href="css/style.css" />
</head>

<body>
    <?php  ?>

    <div class="header">
        <h1>We Write</h1>
    </div>

    <div class="form">
        <div class="author form">
            <h3>Authors Form</h3>

            <form action="includes/DB_Connect1.php" method="POST">
                <label for="author_id">Author ID:</label><br>
                <input type="text" id="author_id" name="author_id" placeholder="Insert Author ID" maxlength="15" required><br>

                <label for="author_full_name">Full Name:</label>
                <input type="text" id="author_full_name" name="author_full_name" placeholder="Insert Author Name" maxlength="60" required><br>

                <label for="author_email">Email:</label>
                <input type="email" id="author_email" name="author_email" placeholder="Insert Author Email" maxlength="50" required><br>

                <label for="author_address">Address:</label>
                <input type="text" id="author_address" name="author_address" placeholder="Insert Author Address" maxlength="50" required><br>

                <label for="author_biography">Biography:</label>
                <textarea id="author_biography" name="author_biography" rows="4" required></textarea><br>

                <label for="author_date_of_birth">Date of Birth:</label>
                <input type="date" id="author_date_of_birth" name="author_date_of_birth" required><br>

                <label for="author_suspended">Suspended:</label>
                <input type="checkbox" id="author_suspended" name="author_suspended" required><br>

                <input type="submit" value="Submit">
            </form>

        </div>

</body>

</html>