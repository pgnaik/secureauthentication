<?php
require 'vendor/autoload.php';
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

// Encoded JWT token received from the client
$encodedToken = " eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJ1c2VyX2lkIjoxMjMsInVzZXJuYW1lIjoicGduIiwiZXhwIjoxNzA4Njk3OTkxfQ.pWZ8ZtKeqnUGq6Nt-RfDl0KtMr6SOTmDz1EiM9Eff4M";

// Define secret key (must match the key used for encoding)
$key = 'siber12345';

try {
    // Decode (verify) the JWT token
    $decoded = JWT::decode($encodedToken, new Key($key, 'HS256'));
    // Access payload data
    echo "User ID: " . $decoded->user_id . "<br>";
    echo "Username: " . $decoded->username . "<br>";
    echo "Expiration Time: " . date('Y-m-d H:i:s', $decoded->exp) . "<br>";
} catch (Exception $e) {
    // Handle token verification failure
    echo "Error: " . $e->getMessage();
}
?>
