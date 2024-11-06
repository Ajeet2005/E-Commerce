<?php
session_start();
$con = mysqli_connect('localhost', 'root', '', 'database');
if (!$con) {
    die("Connection Failed: " . mysqli_connect_error());
}

if (isset($_SESSION['number']) && isset($_POST['profilepic'])) {
    $profilepic = $_POST['profilepic'];
    $number = $_SESSION['number'];

    // Update the profile picture in the database
    $stmt = $con->prepare("UPDATE register SET profilepic = ? WHERE number = ?");
    $stmt->bind_param("ss", $profilepic, $number);
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
if ($stmt->affected_rows > 0) {
    $_SESSION['profilepic'] = $profilepic; // Ensure this is set after success
    echo json_encode(['status' => 'success', 'message' => 'Profile picture updated successfully']);
}
        echo json_encode(['status' => 'success', 'message' => 'Profile picture updated successfully']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Failed to update profile picture']);
    }

    $stmt->close();
}

$con->close();
?>
