<?php
$con = mysqli_connect('localhost', 'root', '', 'email');

if (!$con) {
    die("Connection Failed: " . mysqli_connect_error());
}

$number = $_POST['number'];
$password = $_POST['password'];

// Password hashing for security
$hashed_password = password_hash($password, PASSWORD_DEFAULT);

// Prepared statement to prevent SQL injection
$stmt = $con->prepare("INSERT INTO login (number, password) VALUES (?, ?)");
$stmt->bind_param("ss", $number, $hashed_password);

$response = array();

if ($stmt->execute()) {
    $response['status'] = 'success';
    $response['message'] = 'Thank you for submitting!';
} else {
    $response['status'] = 'error';
    $response['message'] = 'Error: ' . $stmt->error;
}

$stmt->close();
$con->close();

// Return response as JSON
echo json_encode($response);
?>
