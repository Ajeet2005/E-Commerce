<?php
$con = mysqli_connect('localhost', 'root', '', 'database');

if ($con) {
    // Connection Successful
} else {
    die("Connection Failed: " . mysqli_connect_error());
}

$name = $_POST['name'];
$phone = $_POST['phone'];
$email = $_POST['email'];
$your_message = $_POST['message'];

$stmt = $con->prepare("INSERT INTO feedback (name, email, phone, message) VALUES (?, ?, ?, ?)");
$stmt->bind_param("ssss", $name, $email, $phone, $your_message);

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
header("Location:./contact.html");
// echo json_encode($response);
?>