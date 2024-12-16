<?php
// Plain password to hash
$password = "itssecret";

// Generate the hashed password
$hashedPassword = password_hash($password, PASSWORD_BCRYPT);

// Display the hashed password
echo "Plain Password: " . $password . "<br>";
echo "Hashed Password: " . $hashedPassword;
?>