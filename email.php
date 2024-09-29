<?php
$con = mysqli_connect('localhost', 'root', '', 'mail');

if ($con) {
    // Connection Successful
} else {
    die("Connection Failed: " . mysqli_connect_error());
}
// var_dump ($_POST);
$email = $_POST['email'];

// echo $name
// Prepared statement to prevent SQL injection
$stmt = $con->prepare("INSERT INTO mail (email) VALUES (?)");
$stmt->bind_param("s", $email);

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
echo json_encode($response);
?>