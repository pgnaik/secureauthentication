<?php
session_start(); // Start the session

require 'vendor/autoload.php'; // Include the Composer autoloader

use Firebase\JWT\JWT;

// Include your database connection file
include_once 'includes/db.php';

// Retrieve user inputs from the login form
$username = $_POST['username'];
$password = $_POST['password'];
$hashedPasswordInput = hash('sha256', $password);

// SQL query to retrieve hashed password from authentication table based on username
$sql = "SELECT password FROM authentication WHERE username = ?";

// Use prepared statements to prevent SQL injection
$stmt = $conn->prepare($sql);

if ($stmt) {
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->bind_result($hashedPassword);
    $stmt->fetch();
    $stmt->close();
    
    // Check if a hashed password was retrieved
    if ($hashedPassword && ($hashedPasswordInput === $hashedPassword)) {
        // Passwords match, generate JWT token
        $token = [
            'username' => $username,
            'exp' => time() + (60 * 60) // Token expiration time (1 hour)
        ];

        $jwt = JWT::encode($token, 'siber12345', 'HS256'); // Replace 'your_secret_key' with your actual secret key

        // Store the token in the session
        $_SESSION['token'] = $jwt;
        $_SESSION['username'] = $username;

        // After setting $_SESSION['token'] in your login code, add this line to check if the token is stored correctly
echo "Token stored in session: " . $_SESSION['token'];

        // Redirect to the dashboard or any desired page
        header('Location: index.php');
        exit();
    } else {
        // Passwords do not match, return error response
        http_response_code(401); // Unauthorized
        echo json_encode(['message' => 'Incorrect username or password']);
        exit();
    }
} else {
    // Handle prepared statement failure
    http_response_code(500); // Internal Server Error
    echo json_encode(['message' => 'Error in prepared statement']);
    exit();
}
?>
