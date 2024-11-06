<?php
session_start();
if (isset($_POST['country']) && isset($_POST['city'])) {
    $country = $_POST['country'];
    $city = $_POST['city'];

    // Database connection
    $con = mysqli_connect('localhost', 'root', '', 'database');
    if (!$con) {
        die("Connection Failed: " . mysqli_connect_error());
    }

    // Update the country and city in the database
    $number = $_SESSION['number']; // Get the user's number from the session
    $stmt = $con->prepare("UPDATE register SET country = ?, city = ? WHERE number = ?");
    $stmt->bind_param("sss", $country, $city, $number);

    if ($stmt->execute()) {
        // Update the session variables as well
        $_SESSION['country'] = $country;
        $_SESSION['city'] = $city;
    }

    $stmt->close();
    $con->close();
}
?>
