<?php
// Establish a connection to MySQL database
include 'connect.php';
// Create connection

// Prepare and bind SQL statement
$stmt = $conn->prepare("INSERT INTO `users` (username, password, fullname, email, role) VALUES (?, ?, ?, ?, 'user')");
$stmt->bind_param("ssss", $username, $password, $fullname, $email);

// Set parameters and execute
$username = $_POST['username'];
$password = $_POST['password'];
$fullname = $_POST['fullname'];
$email = $_POST['email'];

if ($stmt->execute()) {
    echo "Sign up successful!";
    header('Location: index.php');
} else {
    echo "Error: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
<form action="signup_process.php" method="post">
    <label for="username">Username:</label><br>
    <input type="text" id="username" name="username" required><br>
    
    <label for="password">Password:</label><br>
    <input type="password" id="password" name="password" required><br>
    
    <label for="fullname">Full Name:</label><br>
    <input type="text" id="fullname" name="fullname" required><br>
    
    <label for="email">Email:</label><br>
    <input type="email" id="email" name="email" required><br>
    
    <input type="submit" value="Sign Up">
</form>
