<?php
include 'db_connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Hash the password

    // Prepare and bind
    $stmt = $conn->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $username, $email, $password);

    if ($stmt->execute()) {
        echo "User registered successfully";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>

<!-- HTML Signup Form -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up - Khalid's Kitchen</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <form action="signup.php" method="POST">
        <h2>Sign Up</h2>
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required><br>
        
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required><br>
        
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required><br>
        
        <button type="submit">Sign Up</button>
    </form>
</body>
</html>
