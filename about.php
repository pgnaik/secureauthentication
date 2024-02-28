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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f8f9fa;
        }

        .jumbotron {
            background-color: #007bff;
            color: #fff;
            padding: 3rem;
            margin-bottom: 30px;
        }

        .card {
            border: none;
        }

        .card-body {
            text-align: justify;
        }

        .list-group-item {
            background-color: #f8f9fa;
            border: none;
        }

        .list-group-item:last-child {
            border-bottom-left-radius: 0;
            border-bottom-right-radius: 0;
        }

        .list-group-item:first-child {
            border-top-left-radius: 0;
            border-top-right-radius: 0;
        }
    </style>
    <title>About Us</title>
</head>

<body>

    <div class="container">
        <div class="jumbotron">
            <h1 class="display-4"><center>Our Amazing Team</center></h1>
            <p class="lead">Get to know the people behind our success.</p>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <img src="assets/images/shinde.jpg" class="card-img-top" alt="Team Member 1">
                    <div class="card-body">
                        <h5 class="card-title">Late Dr. A.D.Shinde</h5>
                        <p class="card-text">Founder, a well-known educationist, the then Dean of Shivaji University, Kolhapur, and a renowned Chartered Accountant</p>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <img src="assets/images/rashinde.jpg" class="card-img-top" alt="Team Member 2">
                    <div class="card-body">
                        <h5 class="card-title">Dr. R.A.Shinde</h5>
                        <p class="card-text">President, Managing Trustee, CSIBER, Kolhapur</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mt-4">
            <div class="col-md-6">
                <h2>Our Vision</h2>
                <p>To be an institute of first choice of students</p>
            </div>
            <div class="col-md-6">
                <h2>Core Values</h2>
                <ul class="list-group">
                <li class="list-group-item">Research</li> 
                    <li class="list-group-item">Innovation</li>
                    <li class="list-group-item">Integrity</li>
                    <li class="list-group-item">Teamwork</li>
                    
                </ul>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>
