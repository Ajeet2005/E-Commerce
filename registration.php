<?php
$con = mysqli_connect('localhost', 'root', '', 'mail');

if ($con) {
    // Connection Successful
} else {
    die("Connection Failed: " . mysqli_connect_error());
}
// var_dump ($_POST);
$number = $_POST['number'];
$password = $_POST['password'];

// echo $name
// Prepared statement to prevent SQL injection
$stmt = $con->prepare("INSERT INTO login (number, password) VALUES (?,?)");
$stmt->bind_param("ss", $number, $password);

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