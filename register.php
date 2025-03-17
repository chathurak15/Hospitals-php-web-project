<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    include 'db/config.php';
    include 'functions/user.php';
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $email = $_POST['email'];
    $username = $_POST['username'];
    $role = $_POST['role'];
    $password = $_POST['password'];

    $response = addUser($conn ,$fname, $lname, $email, $username, $password,$role);
    if($response == 'Register successfully'){
        echo "<script>alert('$response'); window.location.href='login.php';</script>";
        exit();
    }
    echo "<script>alert('$response');</script>";
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/register.css">

</head>

<body>
    <div class="container">
        <div class="register-card">
            <div class="card-header">
                <a href="index.php">
                    <img src="assets/images/Care Compass.png" alt="Care Compass Hospital" class="logo">
                </a>
            </div>
            <div class="card-body">
                <form method="POST" action="" onsubmit="return validateForm()">
                    <div class="form-grid">
                        <div class="form-group">
                            <label for="fname">First Name</label>
                            <div class="input-wrapper">
                                <i class="fa-solid fa-user"></i>
                                <input class="form-control" type="text" id="fname" placeholder="First name (Required)" name="fname">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="lname">Last Name</label>
                            <div class="input-wrapper">
                                <i class="fa-solid fa-user"></i>
                                <input class="form-control" type="text" id="lname" placeholder="Last name (Required)" name="lname">
                            </div>
                        </div>
                    </div>
                    <div class="form-grid">
                        <div class="form-group">
                            <label for="email">Email Address</label>
                            <div class="input-wrapper">
                                <i class="fa-solid fa-envelope"></i>
                                <input class="form-control" type="email" id="email" placeholder="Enter your email (Required)" name="email">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="username">Username</label>
                            <div class="input-wrapper">
                                <i class="fa-solid fa-user-tag"></i>
                                <input class="form-control" type="text" id="username" placeholder="Choose a username (Required)" name="username">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <div class="input-wrapper">
                            <i class="fa-solid fa-lock"></i>
                            <input class="form-control" type="password" id="password" placeholder="Create a password" name="password">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="password">Confirm Password</label>
                        <div class="input-wrapper">
                            <i class="fa-solid fa-lock"></i>
                            <input class="form-control" type="password" id="confirmPassword" placeholder="Confirm a password" name="confirmPassword">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="role">Select User Type</label>
                        <div class="input-wrapper">
                            <i class="fa-solid fa-id-badge"></i>
                            <select class="form-select" name="role" id="role">
                                <option value="2">Doctor</option>
                                <option value="0">User</option>
                            </select>
                        </div>
                    </div>
                    <button type="submit" class="btn-register">Register</button>
                    <div class="login-link">
                        Already have an account? <a href="login.php">Sign In</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script>
        function validateForm() {
            // Get form inputs
            const fname = document.getElementById('fname').value.trim();
            const lname = document.getElementById('lname').value.trim();
            const email = document.getElementById('email').value.trim();
            const username = document.getElementById('username').value.trim();
            const password = document.getElementById('password').value.trim();
            const confirmPassword = document.getElementById('confirmPassword').value.trim();
            const role = document.getElementById('role').value;

            // Regex patterns
            const nameRegex = /^[A-Za-z]+$/; // Only letters for first and last name
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/; // Basic email validation
            const usernameRegex = /^[A-Za-z0-9_]{4,20}$/; // Alphanumeric and underscores, 4-20 characters
            const passwordRegex = /^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$/; // At least 8 characters, one letter, one number

            // Validation checks
            if (!nameRegex.test(fname)) {
                alert("Please enter a valid first name (letters only).");
                return false;
            }
            if (!nameRegex.test(lname)) {
                alert("Please enter a valid last name (letters only).");
                return false;
            }
            if (!emailRegex.test(email)) {
                alert("Please enter a valid email address.");
                return false;
            }
            if (!usernameRegex.test(username)) {
                alert("Username must be 4-20 characters long and can only contain letters, numbers, and underscores.");
                return false;
            }
            if (!passwordRegex.test(password)) {
                alert("Password must be at least 8 characters long and contain at least one letter and one number.");
                return false;
            }
            if (password !== confirmPassword) {
                alert("Passwords do not match.");
                return false;
            }
            if (role === "") {
                alert("Please select a role.");
                return false;
            }
            return true;
        }
    </script>
</body>

</html>