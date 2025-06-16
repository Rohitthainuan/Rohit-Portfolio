<?php
// hire_offer_upload.php

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = htmlspecialchars($_POST['name'] ?? '');
    $email = htmlspecialchars($_POST['email'] ?? '');

    if (empty($name) || empty($email) || empty($_FILES['offer_letter']['name'])) {
        echo "<p style='color:red;'>All fields are required.</p>";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "<p style='color:red;'>Invalid email format.</p>";
    } else {
        $uploadDir = 'uploads/';
        $uploadFile = $uploadDir . basename($_FILES['offer_letter']['name']);

        if (move_uploaded_file($_FILES['offer_letter']['tmp_name'], $uploadFile)) {
            echo "<p style='color:green;'>Thank you, $name. Your offer letter has been uploaded successfully!</p>";
        } else {
            echo "<p style='color:red;'>Failed to upload offer letter.</p>";
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Hire Me - Offer Letter Upload</title>
</head>
<body>
    <h1>Hire Me - Upload Offer Letter</h1>
    <form method="POST" action="" enctype="multipart/form-data">
        <label for="name">Name:</label><br>
        <input type="text" name="name" required><br><br>

        <label for="email">Email:</label><br>
        <input type="email" name="email" required><br><br>

        <label for="offer_letter">Upload Offer Letter:</label><br>
        <input type="file" name="offer_letter" accept="application/pdf" required><br><br>

        <input type="submit" value="Submit">
    </form>
</body>
</html>


