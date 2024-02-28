<?php
session_start();
// Function to check if the user is logged in
function isLoggedIn() {
    return isset($_SESSION['username']);
}
// Check if the user is logged in
if (isLoggedIn()) {
    // User is logged in, display logout link
    $loginLogoutLinkText = 'Logout';
    $loginLogoutLinkAction = 'logout.php';
} else {
    // User is not logged in, display login link
    $loginLogoutLinkText = 'Login';
    $loginLogoutLinkAction = 'login.php';
}
?>
<?php
// Check if the logout query parameter is set
if (isset($_GET['logout']) && $_GET['logout'] == 'true') {
    $logoutMessage = "You are successfully logged out of the System.";
} else {
    $logoutMessage = ""; // No logout message by default
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-
                                                                                                                            fit=no">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <style>
        .jumbotron-heading {
            font-family: 'Arial', sans-serif;
            font-size: 24px;
            font-weight: bold;
        }
        .custom-jumbotron {
            padding: 20px; /* Adjust padding as needed */
            height: 200px; /* Adjust the height */
        }
        .navbar-custom .navbar-nav .nav-link {
            color: #fff;
        }
        .navbar-custom .navbar-toggler-icon {
            background-color: #fff;
        }
        .navbar-custom .navbar-nav .nav-link:hover,
        .navbar-custom .navbar-toggler:hover {
            color: #000 !important;
            background-color: #fff !important;
        }
        .token-container {
            background-color: #f2f2f2;
            padding: 10px;
            border-radius: 10px;
            text-align: center;
            width:90%;
            margin-left:20px;
        }
        .token {
            color: green;
            font-weight: bold;
        }
    </style>
    <title>Login System</title>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary navbar-custom">
        <div class="container">
            <a class="navbar-brand" href="#">CSIBER</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-
                                                                                                  target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle 
                                                                                                                  navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="#" onclick="loadPage('home.php')">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#" onclick="loadPage('about.php')">About</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#" onclick="loadPage('contact.php')">Contact</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link btn btn-outline-light" href="#" onclick="loadRegistration()">Register</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link btn btn-outline-light" href="<?php echo $loginLogoutLinkAction; ?>"><?php echo $loginLogoutLinkText; ?></a>
                    </li>
                </ul>
            </div>
        </div>
    </nav><br>
    <?php
    // Check if the token is present in the session
    if (isset($_SESSION['token'])) {
        // Display the token inside a styled container
        echo '<div class="token-container">';
        echo '<b>Token ID - </b><span class="token">' . $_SESSION['token'] . '</span>';
        echo '</div>';
    }
    ?>
    <div class="container mt-5">
        <?php if (!empty($logoutMessage)) : ?>
        <div class="alert alert-success" role="alert">
            <?php echo $logoutMessage; ?>
        </div>
        <?php endif; ?>
        <!-- Your other content goes here -->
    </div>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6" id="content-container">
                <?php
                // Check for session messages and display Bootstrap alert
                if (isset($_SESSION["message"])) {
                    $alert_type = isset($_SESSION["alert_type"]) ? $_SESSION["alert_type"] :                                                                                                                                                                  
                                                                                                                                      "info";
                    echo '<div class="alert alert-' . $alert_type . ' alert-dismissible fade show"                                                                                                                                   
                                                                          role="alert"> ' . $_SESSION["message"] . '
                            <button type="button" class="close" data-dismiss="alert" aria-
                                                                                                                            label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>';
                    // Clear session messages
                    unset($_SESSION["message"]);
                    unset($_SESSION["alert_type"]);
                }
                ?>
            </div>
        </div>
    </div>
    <script src="assets/js/jquery-3.6.0.min.js"></script>
    <script src="assets/js/bootstrap.bundle.min.js"></script>
    <script>
        // Function to load pages dynamically using AJAX
        // Function to load pages dynamically using AJAX    
        
        // Function to load pages dynamically using AJAX
        function loadRegistration() {
            $.ajax({
                url: 'register.php',
                type: 'GET',
                dataType: 'html',
                success: function (data) {
                    $('#content-container').html(data);
                },
                error: function () {
                    alert('Error loading registration page.');
                }
            });
        }


   function loadPage(page) {    
    $.ajax({
        url: 'verify-token.php',
        type: 'GET',
        headers: {
    'Authorization': '<?php if (isset($_SESSION['token'])) echo $_SESSION['token']; ?>'
},        
        success: function(response) {
            // If token is verified, load the requested page
            console.log(response);
            let jsonString = response.toString();
            console.log(jsonString);
// Parse the JSON string into a JavaScript object
let responseObject = JSON.parse(jsonString);
// Access the value of the 'status' property
let status = responseObject.status;
console.log(status); // Output: "success"
           
            if (status === 'success') {
                $.ajax({
                    url: page,
                    type: 'GET',
                    dataType: 'html',
                    success: function (data) {
                        $('#content-container').html(data);
                    },
                    error: function () {
                        alert('Error loading page.');
                    }
                });
            } else {
                alert('Token is invalid. Please login again.'); // Show error message if token is 
                                                                                              invalid
            }
        },
        error: function () {
            alert('Error verifying token.');
        }
    });
}
        // Function to handle logout
        function logout() {
            $.ajax({
                url: 'logout.php',
                type: 'GET',
                success: function () {
                    window.location.href = 'index.php'; // Redirect to index.php after logout
                },
                error: function () {
                    alert('Error logging out.');
                }
            });
        }
    </script>
</body>
</html>
