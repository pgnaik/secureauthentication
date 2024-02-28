<?php

require 'vendor/autoload.php'; // Include the Composer autoloader

use Firebase\JWT\JWT;
use Firebase\JWT\Key;

// Get the JWT token from the request headers
$headers = getallheaders();
$jwt = $headers['Authorization'] ?? '';
//echo $jwt;
//$jwt = $_SERVER['HTTP_AUTHORIZATION'] ?? '';
//$jwt='eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJ1c2VybmFtZSI6InBnbiIsImV4cCI6MTcwODYxOTI0Nn0.Zj-SyiLD701BNsf_NDJ_LfqmP7GlCedoBdSAWWku764';
//echo "Received JWT: $jwt";
if (!$jwt) {
    http_response_code(401); // Unauthorized
    echo json_encode(['message' => 'No token provided']);
    exit();
}

// Log the received token
file_put_contents('token.log', 'Received token: ' . $jwt . PHP_EOL, FILE_APPEND);

try {
    // Verify the JWT token
    $key='siber12345';
    $alg='HS256';
    $decoded = JWT::decode($jwt, new Key($key, 'HS256'));



// Replace 'your_secret_key' with your actual secret key
    
    // Token is valid, proceed with the requested operation
    // For example, retrieve user data from the decoded token and perform the necessary action
   // header('Content-Type: application/json');
    http_response_code(200);
    
    // Sample response
    echo json_encode(['status' => 'success', 'message' => 'Token is valid', 'user' => $decoded->username]);
} catch (Exception $e) {
    // Token is invalid or expired
    http_response_code(401); // Unauthorized
    echo json_encode(['status' => 'error', 'message' => 'Token is invalid', 'error' => $e->getMessage()]);
    exit();
}

