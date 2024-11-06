<?php
session_start(); // Start the session to store user data

$con = mysqli_connect('localhost', 'root', '', 'database');

if (!$con) {
    die("Connection Failed: " . mysqli_connect_error());
}

// Check if this is a login or registration request
if (isset($_POST['action']) && $_POST['action'] == 'register') {
    // Registration code
    $number = $_POST['number'];
    $password = $_POST['password'];
    $full_name = $_POST['full_name'];
    $month = $_POST['month'];
    $day = $_POST['day'];
    $year = $_POST['year'];
    $DOB = $year . "/" . $month . "/" . $day;

    // Prepared statement to prevent SQL injection
    $stmt = $con->prepare("INSERT INTO register (number, password, full_name, dob) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $number, $password, $full_name, $DOB);

    $response = array();

    if ($stmt->execute()) {
        $response['status'] = 'success';
        $response['message'] = 'Thank you for registering!';
    } else {
        $response['status'] = 'error';
        $response['message'] = 'Error: ' . $stmt->error;
    }

    $stmt->close();
    echo json_encode($response);

} elseif (isset($_POST['action']) && $_POST['action'] == 'login') {
    // Login code
    $number = $_POST['number'];
    $password = $_POST['password'];

    // Prepared statement to prevent SQL injection
    $stmt = $con->prepare("SELECT * FROM register WHERE number = ?");
    $stmt->bind_param("s", $number);
    $stmt->execute();

    $result = $stmt->get_result();
    $user = $result->fetch_assoc(); // Fetch the user record
    $response = array();

    if ($user) {
        // Verifying the password (ensure plain text comparison matches how you stored it)
        if ($password == $user['password']) {
            // Store user information in session
            $_SESSION['number'] = $user['number'];
            $_SESSION['full_name'] = $user['full_name'];
            $_SESSION['email'] = isset($user['email']) ? $user['email'] : ''; // Optional field
            $_SESSION['birthdate'] = $user['dob'];
            $_SESSION['last_activity'] = time(); // Set the last activity time for session timeout

            // Fetch and store profile picture from the database or set a default if null
            $profile_pic = !empty($user['profilepic']) ? $user['profilepic'] : 'images/default-pic.png';
            $_SESSION['profile_pic'] = $profile_pic;

            $response['status'] = 'success';
            $response['message'] = 'Login successful!';
            $response['redirect'] = 'loginprofile.php'; // Redirect user to profile page

        } else {
            $response['status'] = 'error';
            $response['message'] = 'Incorrect password.';
        }
    } else {
        $response['status'] = 'error';
        $response['message'] = 'User not found.';
    }

    $stmt->close();
    echo json_encode($response);
}

$con->close();
?>
