<?php
session_start();

// Check if the user is not logged in and a requested page is set
if (!isset($_SESSION['username'])) {
    header("Location: login.php"); // Redirect to the login page
    exit; // Stop further execution
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f8f9fa;
        }

        .contact-container {
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
            margin-top: 50px;
            max-width: 600px; /* Adjust the max-width as needed */
            margin-left: auto;
            margin-right: auto;
        }

        .contact-form label {
            font-weight: bold;
            margin-bottom: 0.5rem;
        }

        .contact-form input,
        .contact-form textarea {
            width: 100%;
            padding: 8px;
            margin-bottom: 1rem;
            border: 1px solid #ced4da;
            border-radius: 4px;
        }

        .contact-form button {
            padding: 10px 20px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .contact-form button:hover {
            background-color: #0056b3;
        }

        .logo {
            max-width: 100px;
            height: auto;
            margin-right: 20px;
        }

        .rounded-heading {
            width: 500px;
            background-color: #007bff;
            color: #fff;
            font-size: 32px;
            font-weight: bold;
            padding: 10px;
            border-radius: 10px;
            display: inline-block;
        }
    </style>
    <title>Contact Us</title>
</head>

<body>

    <div class="container contact-container">
        <div class="row">
            <div class="col-lg-12">
                <div class="d-flex align-items-center mb-4">
                    <img src="assets/images/siber.jpg" alt="Company Logo" class="logo">
                    <div class="rounded-heading"><center>Get in Touch</center></div>
                </div>
                <form class="contact-form">
                    <div class="form-group">
                        <label for="name">Your Name:</label>
                        <input type="text" class="form-control" id="name" name="name" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Your Email:</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                    </div>
                    <div class="form-group">
                        <label for="message">Your Message:</label>
                        <textarea class="form-control" id="message" name="message" rows="4" required></textarea>
                    </div>
                    <center><button type="submit" class="btn btn-primary">Send Message</button></center>
                </form>
            </div>
        </div>
    </div>

    <script src="assets/js/jquery-3.6.0.min.js"></script>
    <script src="assets/js/bootstrap.bundle.min.js"></script>

</body>

</html>
