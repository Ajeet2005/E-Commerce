<?php
$con = mysqli_connect('localhost', 'root', '', 'email');

if (!$con) {
    die("Connection Failed: " . mysqli_connect_error());
}
if (isset($_POST['Login'])) {
    // Fetching user input
    $number = $_POST['number'];
    $password = $_POST['password'];
    
    // Prepared statement to prevent SQL injection
    $stmt = $con->prepare("SELECT * FROM registration WHERE number = ?");
    $stmt->bind_param("s", $number);
    $stmt->execute();
    
    // Fetch the result
    $result = $stmt->get_result();
    $user = $result->fetch_assoc(); // Get the user record

    if ($user) {
        // Verifying the password with the hashed password in the database
        if ($password == $user['password']) {
            // Success: Password matches
            echo json_encode(['status' => 'success', 'message' => 'Login successful!']);
            // You can start a session here to log the user in
        } else {
            // Failure: Incorrect password
            echo json_encode(['status' => 'error', 'message' => 'Incorrect password.']);
        }
    } else {
        // Failure: User not found
        echo json_encode(['status' => 'error', 'message' => 'User not found.']);
    }

    // Close statement and connection
    $stmt->close();
    $con->close();
}

?>




