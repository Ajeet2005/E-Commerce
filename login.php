<?php
$con = mysqli_connect('localhost', 'root', '', 'database');

if ($con) {
    // Connection Successful
} else {
    die("Connection Failed: " . mysqli_connect_error());
}
// var_dump ($_POST);
$number = $_POST['number'];
$password = $_POST['password'];
$full_name = $_POST['full_name'];
$month = $_POST['month'];
// $day = $_POST['day'];
// $year = $_POST['year'];


// echo $name
// Prepared statement to prevent SQL injection
$stmt = $con->prepare("INSERT INTO register (number, password, full_name, month) VALUES (?,?,?,?)");
$stmt->bind_param("ssss", $number, $password, $full_name, $month);

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