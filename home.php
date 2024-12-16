<?php
// Start the session
session_start();

// Check if the user is logged in
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    // If not logged in, redirect to the login page
    header("Location: index.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Page</title>
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background-color: #1e272e; /* Darker Gray */
            color: #ffffff;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .container {
            text-align: center;
            width: 90%;
            max-width: 400px;
            padding: 20px;
            background-color: #2c3e50; /* Slightly lighter */
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.3);
        }
        a {
            display: inline-block;
            margin-top: 20px;
            padding: 10px 20px;
            background-color: #e74c3c; /* Red */
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
            font-size: 16px;
        }
        a:hover {
            background-color: #c0392b; /* Darker red */
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Welcome, <?php echo $_SESSION['username'] ?>!</h1>
        <p>This is your home page.</p>
        <a href="logout.php">Logout</a>
    </div>
</body>

</html>