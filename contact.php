<?php
$con = mysqli_connect('localhost', 'root', '', 'email');

if ($con) {
    // Connection Successful
} else {
    die("Connection Failed: " . mysqli_connect_error());
}
<<<<<<< HEAD

$name = $_POST['name'];
$phone = $_POST['phone'];
$email = $_POST['email'];
$your_message = $_POST['message'];

$stmt = $con->prepare("INSERT INTO email (name, email, phone, message) VALUES (?, ?, ?, ?)");
$stmt->bind_param("ssss", $name, $email, $phone, $your_message);
=======
// var_dump ($_POST);
$name = $_POST['name'];
$phone = $_POST['phone'];
$email = $_POST['email'];
$your_message = $_POST['your_message'];

// echo $name
// Prepared statement to prevent SQL injection
$stmt = $con->prepare("INSERT INTO email (Name, Phone, Email, Message) VALUES (?, ?, ?, ?)");
$stmt->bind_param("ssss", $name, $phone, $email, $your_message);
>>>>>>> e39ec0b364d600e8a5beeb20c002eb71eaf9a238

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
<<<<<<< HEAD

echo json_encode($response);
=======
header("Location:./contact.html");
// echo json_encode($response);
>>>>>>> e39ec0b364d600e8a5beeb20c002eb71eaf9a238
?>