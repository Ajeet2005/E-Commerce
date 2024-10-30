<?php
session_start(); // Start the session

// Set session timeout to 1 minute (60 seconds)
$session_lifetime = 60;

// Check if session is set and still valid
if (isset($_SESSION['number']) && (time() - $_SESSION['last_activity'] < $session_lifetime)) {
    $_SESSION['last_activity'] = time(); // Update last activity timestamp
} else {
    // If session expired, destroy and redirect to login
    session_unset();
    session_destroy();
    header('Location: login.html'); // Redirect to login page
    exit();
}

// Retrieve session data for profile display
$number = $_SESSION['number'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }

        body {
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            background-color: #f3f4f6;
            color: #333;
        }

        .profile-container {
            width: 90%;
            max-width: 800px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            padding: 2rem;
            text-align: center;
        }

        .profile-header {
            font-size: 2rem;
            color: #4a90e2;
            margin-bottom: 0.5rem;
        }

        .user-info {
            margin: 1.5rem 0;
            line-height: 1.6;
        }

        .user-info p {
            font-size: 1.1rem;
            color: #555;
        }

        .logout-btn {
            display: inline-block;
            padding: 0.7rem 1.5rem;
            background-color: #e74c3c;
            color: #fff;
            text-decoration: none;
            font-weight: bold;
            border-radius: 5px;
            margin-top: 1rem;
            transition: background-color 0.3s ease;
        }

        .logout-btn:hover {
            background-color: #c0392b;
        }
    </style>
</head>
<body>
    <div class="profile-container">
    <h1 class="profile-header">Welcome, <?php echo $_SESSION['full_name']; ?>!</h1>
    <div class="user-info">
            <p><strong>Number:</strong> <?php echo $_SESSION['number']; ?></p>

            <!-- Add more fields here if needed -->
        </div>
        <a href="logout.php" class="logout-btn">Log Out</a>
    </div>
</body>
</html>
