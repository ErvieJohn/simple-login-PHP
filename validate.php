<?php
// Simple validation
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['username']) && isset($_POST['password'])) {
    $host = "localhost";
    $username = "root";
    $password = ""; // Default is empty
    $database = "simplelogin_db";

    $response = "";

    // Create connection
    $conn = new mysqli($host, $username, $password, $database);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    // echo "Connected successfully!";
    
    // Get input values from the form
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Prepare a query to get the user by username
    $stmt = $conn->prepare("SELECT user_id, password FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->store_result();

    // Check if the user exists
    if ($stmt->num_rows === 1) {
        // Bind the result (retrieving the hashed password)
        $stmt->bind_result($id, $hashedPassword);
        $stmt->fetch();

        // Verify the entered password with the stored hashed password
        if (password_verify($password, $hashedPassword)) {
            // Success: Start session or redirect
            $_SESSION['user_id'] = $id; // Store user ID in session
            // echo "Login successful! Welcome, $username.";

            // Set session variables to indicate the user is logged in
            session_start();
            $_SESSION['loggedin'] = true;
            $_SESSION['username'] = $username;  // Store username in session
            // header("Refresh: 1; url=home.php");
            $response = array(
                "status" => true,
                "message" => "Login successful!",
            );

            // header('Location: home.php');
        } else {
            // Invalid password
            // echo "Invalid username or password. Please try again.";

            $response = array(
                "status" => false,
                "message" => "Invalid username or password. Please try again.",
            );
        }
    } else {
        // User not found
        // echo "Invalid username or password. Please try again.";

        $response = array(
            "status" => false,
            "message" => "Invalid username or password. Please try again."
        );
        // echo "No account found for username: $username.";
    }

    // Close statement and connection
    $stmt->close();
    $conn->close();

    // Encode the data as a JSON string and send it as the response
    echo json_encode($response);

} else {
    header('Location: index.php');
    exit();
}
?>