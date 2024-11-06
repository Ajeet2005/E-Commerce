<?php
session_start();

if (!isset($_SESSION['number'])) {
    header('Location: login.html'); // Redirect if not logged in
    exit();
}

$full_name = $_SESSION['full_name'];
$email = $_SESSION['email'];
$birthdate = $_SESSION['birthdate'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
        }

        body {
            background: linear-gradient(to right, #ece9e6, #ffffff);
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            padding: 20px;
        }

        .profile-container {
            width: 70%;
            margin: 20px auto;
            padding: 20px;
            border-radius: 10px;
            background-color: #f9f9f9;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s, box-shadow 0.3s;
        }

        .profile-container:hover {
            transform: scale(1.02);
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.2);
        }

        .profile-header {
            display: flex;
            align-items: center;
            margin-bottom: 20px;
        }

        .profile-pic {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            margin-right: 20px;
            transition: transform 0.3s;
        }

        .profile-pic:hover {
            transform: scale(1.1);
        }

        .profile-info h2 {
            font-size: 26px;
            margin-bottom: 5px;
            color: #333;
        }

        .profile-section {
            margin-top: 20px;
            padding: 15px;
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            transition: background-color 0.3s;
        }

        .profile-section:hover {
            background-color: #f1f1f1;
        }

        .profile-section h3 {
            margin-bottom: 10px;
            color: #2980b9;
            font-size: 22px;
        }

        .profile-section p {
            margin-bottom: 8px;
        }

        .logout-button {
            display: block;
            width: 100%;
            padding: 12px;
            background-color: #e74c3c;
            color: white;
            border: none;
            border-radius: 5px;
            font-size: 18px;
            cursor: pointer;
            margin-top: 20px;
            transition: background-color 0.3s, transform 0.3s;
        }

        .logout-button:hover {
            background-color: #c0392b;
            transform: translateY(-2px);
        }

        #address-form label {
            font-weight: bold;
            display: block;
            margin-top: 10px;
        }

        #address-form input {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
            transition: border 0.3s;
        }

        #address-form input:focus {
            border: 2px solid #3498db;
        }

        #address-form button {
            padding: 10px;
            background-color: #3498db;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s, transform 0.3s;
        }

        #address-form button:hover {
            background-color: #2980b9;
            transform: translateY(-2px);
        }

        .profile-pic-dropdown {
            margin-top: 10px;
            width: 100%;
            padding: 8px;
            border-radius: 4px;
            font-size: 16px;
            border: 1px solid #ccc;
            transition: border 0.3s;
        }

        .profile-pic-dropdown:focus {
            border: 2px solid #3498db;
        }
    </style>
</head>
<body>

<div class="profile-container">
    <div class="profile-header">
        <img src="<?php echo htmlspecialchars($profile_pic); ?>" alt="Profile Picture" class="profile-pic" id="selected-profile-pic">
        <div class="profile-info">
            <h2 id="user-fullname">Welcome, <?php echo htmlspecialchars($full_name); ?></h2>
            <p class="profile-role">Consumer</p>
            <p class="profile-country" id="user-country">Nepal</p>
        </div>
    </div>

    <div class="profile-section">
        <h3>Select Profile Picture</h3>
        <select id="profile-pic-dropdown" class="profile-pic-dropdown" onchange="selectProfilePic(this.value)">

            <option value="images/default-pic.png">Default</option>
            <option value="images/1.png">Profile Picture 1</option>
            <option value="images/2.png">Profile Picture 2</option>
            <option value="images/3.png">Profile Picture 3</option>
            <option value="images/a4.png">Profile Picture 4</option>
        </select>
    </div>

    <div class="profile-section">
        <h3>Personal Information</h3>

        <p><strong>Full Name:</strong> <?php echo htmlspecialchars($full_name); ?></p>
        <p><strong>Email:</strong> <?php echo htmlspecialchars($email); ?></p>
        <p><strong>Phone:</strong> <?php echo htmlspecialchars($_SESSION['number']); ?></p>
        <p><strong>Birthdate:</strong> <?php echo htmlspecialchars($birthdate); ?></p>
        <p><strong>Country:</strong> <?php echo htmlspecialchars($_SESSION['country']); ?></p>
<p><strong>City:</strong> <?php echo htmlspecialchars($_SESSION['city']); ?></p>

    </div>

    <div class="profile-section">
        <h3>Address</h3>
        <form id="address-form">
            <label for="country">Country</label>
            <input type="text" id="country" name="country" placeholder="Enter country" required>
            
            <label for="city">City/State</label>
            <input type="text" id="city" name="city" placeholder="Enter city/state" required>
            
            <button type="button" onclick="updateAddress()">Save Address</button>
        </form>
        <p><strong>Country:</strong> <span id="display-country">United Kingdom</span></p>
        <p><strong>City/State:</strong> <span id="display-city">Leeds, East London</span></p>
    </div>

    <button onclick="logout()" class="logout-button">Log Out</button>
</div>
<script>
    function logout() {
        window.location.href = 'logout.php'; // Redirect to logout.php when the button is clicked
    }
</script>

<script>
    function selectProfilePic(picUrl) {
        // Update selected profile picture
        document.getElementById('selected-profile-pic').src = picUrl;

        // Save the selection using AJAX
        saveProfilePic(picUrl);
    }

    function saveProfilePic(picUrl) {
        const xhr = new XMLHttpRequest();
        xhr.open("POST", "save_profile_pic.php", true);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xhr.onreadystatechange = function () {
            if (xhr.readyState === 4 && xhr.status === 200) {
                alert("Profile picture updated successfully!");
            }
        };
        xhr.send("profile_pic=" + encodeURIComponent(picUrl));
    }

    function updateAddress() {
        const country = document.getElementById('country').value;
        const city = document.getElementById('city').value;

        if (country && city) {
            document.getElementById('display-country').innerText = country;
            document.getElementById('display-city').innerText = city;

            alert("Address updated successfully!");
        } else {
            alert("Please enter both country and city.");
        }
    }

    function logout() {
        window.location.href = 'logout.php';
    }
</script>

</body>
</html>
