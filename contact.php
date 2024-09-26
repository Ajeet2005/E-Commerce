<?php
$con = mysqli_connect('localhost', 'root', '', 'email');

if ($con) {
    // Connection Successful
} else {
    die("Connection Failed: " . mysqli_connect_error());
}
// var_dump ($_POST);
$name = $_POST['name'];
$phone = $_POST['phone'];
$email = $_POST['email'];
$your_message = $_POST['your_message'];

// echo $name
// Prepared statement to prevent SQL injection
$stmt = $con->prepare("INSERT INTO email (Name, Phone, Email, Message) VALUES (?, ?, ?, ?)");
$stmt->bind_param("ssss", $name, $phone, $email, $your_message);

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
header("Location:./contact.html");
// echo json_encode($response);
?>