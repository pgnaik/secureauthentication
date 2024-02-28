<?php
// Include your database connection file
include_once 'includes/db.php';

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve user inputs from the registration form
    $name = $_POST['name'];
    $address = $_POST['address'];
    $city = $_POST['city'];
    $state = $_POST['state'];
    $pincode = $_POST['pincode'];
    $username = $_POST['username'];
    $password = hash('sha256', $_POST['password']); // Hash the password using SHA-256

    // SQL query to insert user data into the registration table
    $sql = "INSERT INTO registration (name, address, city, state, pincode, username) VALUES (?, ?, ?, ?, ?, ?)";

    // Use prepared statements to prevent SQL injection
    $stmt = $conn->prepare($sql);
    
    if ($stmt) {
        $stmt->bind_param("ssssss", $name, $address, $city, $state, $pincode, $username);
        $stmt->execute();

        // Check if the user was successfully registered
        if ($stmt->affected_rows === 1) {
            // Now, insert the username and hashed password into the authentication table
            $authSql = "INSERT INTO authentication (username, password) VALUES (?, ?)";
            $authStmt = $conn->prepare($authSql);

            if ($authStmt) {
                $authStmt->bind_param("ss", $username, $password);
                $authStmt->execute();

                // Check if the authentication record was successfully inserted
                if ($authStmt->affected_rows === 1) {
                    session_start();
                    $_SESSION['message'] = 'Registration successful! You can now log in.';
                    $_SESSION['alert_type'] = 'success';
                    header('Location: index.php'); // Redirect to the login page
                    exit();
                } else {
                    // Handle authentication table insertion failure
                    session_start();
                    $_SESSION['message'] = 'Registration failed. Please try again.';
                    $_SESSION['alert_type'] = 'danger';
                    header('Location: register.php'); // Redirect back to the registration page
                    exit();
                }
            } else {
                // Handle authentication table prepared statement failure
                die("Error in authentication table prepared statement: " . $conn->error);
            }
        } else {
            // Handle registration table insertion failure
            session_start();
            $_SESSION['message'] = 'Registration failed. Please try again.';
            $_SESSION['alert_type'] = 'danger';
            header('Location: register.php'); // Redirect back to the registration page
            exit();
        }
    } else {
        // Handle registration table prepared statement failure
        die("Error in registration table prepared statement: " . $conn->error);
    }

    // Close prepared statements and the database connection
    $stmt->close();
    $authStmt->close();
    $mysqli->close();
} else {
    // If the form was not submitted, redirect to the registration page
    header('Location: register.php');
    exit();
}
?>
