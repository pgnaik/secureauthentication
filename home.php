<?php
session_start();

// Check if the user is not logged in
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
    <style>
        body {
            margin: 0;
            overflow: hidden;
            font-family: 'Arial', sans-serif;
        }

        .hero-section {
            margin-left: -150px; /* Adjust the left margin as needed */
            display: flex;
            align-items: center;
            justify-content: center;
            width: 1200px;
            height: 100vh;
            perspective: 1000px;
            perspective-origin: 50% 50%;
            overflow: hidden;
        }

        .building-container {
            position: absolute;
            top: 50%;
            left: -150px; /* Align to the left */
            transform: translate(0, -50%) rotateY(0deg);
            transform-style: preserve-3d;
            animation: rotateBuilding 5s linear forwards;
        }

        .building {
            width: 1200px;
            height: 500px;
            background: url('assets/images/building.jpg') center/cover;
            transform: translateZ(100px);
            transition: transform 0.5s ease-in-out;
        }

        .hero-content {
            position: absolute;
            top: 50%;
            left: 35%;
            transform: translate(-50%, -50%);
            text-align: center;
            z-index: 2;
        }

        .hero-content h1 {
            font-size: 3rem;
            color: #fff;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
        }

        @keyframes rotateBuilding {
            0% {
                transform: translate(0, -50%) rotateY(0deg);
            }
            100% {
                transform: translate(0, -50%) rotateY(360deg);
            }
        }
    </style>
    <title>Attractive 3D Home Page</title>
</head>

<body>

    <div class="hero-section">
        <div class="building-container">
            <div class="building"></div>
        </div>
        <div class="hero-content">
            <h1>Welcome to CSIBER Institute</h1>
            <p><font color="white">Explore endless possibilities in education.</font></p>
        </div>
    </div>

</body>

</html>
