<?php
session_start(); // Start the session

$con = mysqli_connect('localhost', 'root', '', 'database');
if (!$con) {
    die("Connection Failed: " . mysqli_connect_error());
}

// Set session timeout to 1 minute (60 seconds)
$session_lifetime = 60;
ini_set('session.gc_maxlifetime', $session_lifetime);
setcookie(session_name(), session_id(), time() + $session_lifetime, "/");

if (isset($_POST['Login'])) {
    $number = $_POST['number'];
    $password = $_POST['password'];
    
    // Prepared statement to prevent SQL injection
    $stmt = $con->prepare("SELECT * FROM register WHERE number = ?");
    $stmt->bind_param("s", $number);
    $stmt->execute();
    
    $result = $stmt->get_result();
    $user = $result->fetch_assoc(); // Get the user record
var_dump ($user);

    if ($user) {
        // Verifying the password
        if ($password == $user['password']) {
            // Store additional user information in session
            $_SESSION['number'] = $user['number'];
            $_SESSION['full_name'] = $user['full_name'];
            $_SESSION['email'] = $user['email'];
            $_SESSION['birthdate'] = $user['dob'];
            $_SESSION['last_activity'] = time(); // Set the last activity time
        
            header('Location: loginprofile.php'); // Redirect to the profile page
            exit();
        }
         else {
            // header('Location: registration.html?message=Account details not valid'); // Redirect to the profile page
// message at the top of web alert type of message
            // echo json_encode(['status' => 'error', 'message' => 'Incorrect password.']);
        }

    } else {
        echo json_encode(['status' => 'error', 'message' => 'User not found.']);
    }

    $stmt->close();
    $con->close();
}
?>
