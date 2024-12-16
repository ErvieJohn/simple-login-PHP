<?php 
// Start the session
session_start();

// Check if the user is already logged in
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
    // If logged in, redirect to the home page
    header("Location: home.php");
    exit;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background-color: #34343b; /* Dark Blue */
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
            background-color: #000000; /* Slightly lighter dark */
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.3);
        }
        input {
            width: 95%;
            padding: 10px;
            margin: 10px 0;
            border: none;
            border-radius: 5px;
        }
        button {
            width: 100%;
            padding: 10px;
            margin-top: 10px;
            background-color: #34343b; /* Purple */
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }
        button:hover {
            background-color: #1f2ce1; /* Slightly brighter purple */
        }
        #response {
            color:rgb(255, 0, 0);
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Login</h1>
        <form id="loginForm">
            <input type="text" name="username" placeholder="Username" oninput="clearResponse()" required>
            <input type="password" name="password" placeholder="Password" oninput="clearResponse()" required>
            <div id="response"></div>
            <button type="submit">Login</button>
        </form>
    </div>
</body>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    $(document).ready(function() {
        $('#loginForm').submit(function(e) {
            e.preventDefault();  // Prevent the form from submitting normally

            // Serialize form data to send in the AJAX request
            var formData = $(this).serialize();

            // Make AJAX request
            $.ajax({
                url: 'validate.php',  // The PHP script to process the form
                type: 'POST',         // Use POST method
                data: formData,       // Send the serialized form data
                success: function(response) {
                    response = JSON.parse(response);
                    // console.log("response: ", response.status);
                    // Display the server's response in the 'response' div
                    if(response.status){
                        window.location.href = 'home.php';
                    } else {
                        $('#response').html(response.message);
                    }
                },
                error: function(xhr, status, error) {
                    // Handle any errors
                    $('#response').html("Error: " + error);
                }
            });
        });
    });

    function clearResponse() {
        $('#response').html("");
    }
</script>

</html>