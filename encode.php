<?php
require 'vendor/autoload.php';
use Firebase\JWT\JWT;

// Define payload data
$payload = [
    'user_id' => 123,
    'username' => 'pgn',
    'exp' => time() + 3600 // Expiration time: current time + 1 hour
];

// Define secret key (replace with your actual secret key)
$secretKey = 'siber12345';

// Encode (sign) the JWT token
$jwtToken = JWT::encode($payload, $secretKey,'HS256');
echo "Encoded JWT token: " . $jwtToken;
?>
