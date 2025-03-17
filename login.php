<?php
session_start();
$error = '';

//username = chathura15 | password = 1234

//if the form is submitted
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    include 'db/config.php';
    include 'functions/user.php';
    $email = $_POST['email'];
    $password = $_POST['password'];
    $error = login($email, $password, $conn);
}
//if user is already logged in, redirect to the dashboard(can't login again)
if($error == ''){
    include 'functions/user.php';
    if(islogin()){
        checklogin();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="assets/css/login.css">
</head>

<body class="loading authentication-bg-pattern">
    <div class="account-pages">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-5 ">
                    <div class="card">
                        <div class="card-body">
                            <div class="text-center mb-4">
                                <a href="index.php">
                                    <img src="assets/images/Care Compass.png" alt="Care Compass Hospital" height="110">
                                </a>
                                <!-- <h2 class="text-muted mt-3">Care Compass Hospital</h2> -->
                            </div>
                            <div class="text-center pt-1 mb-2">
                                <h4 class="text-uppercase">Login</h4>
                            </div>

                            <form method="POST">
                                <div class="error">
                                    <p class='text-danger'><?= $error??''?></p>
                                <div class="pt-1 mb-3 input-icon">
                                    <i class="feather icon-mail"></i>
                                    <label for="emailaddress" class="form-label">Username or Email Address</label>
                                    <input class="form-control" type="text" id="emailaddress"  placeholder="Enter your Username or email" name="email">
                                </div>

                                <div class="mb-3 input-icon">
                                    <i class="feather icon-lock"></i>
                                    <label for="password" class="form-label">Password</label>
                                    <input class="form-control" type="password" id="password" placeholder="Enter your password" name="password">
                                </div>

                                <div class="d-grid">
                                    <button class="btn btn-primary" type="submit">LogIn</button>
                                </div>
                                <div class="mb-1 mt-3">
                                        <label class="text-success" for="checkbox-signin" style="align-self:e;">New to Care Compass?</label>
                                        <a href="register.php" class="text-primary">Register</a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                    <!-- <div class="text-center mt-3">
                        <p class="text-muted">Forgot your password? <a href="pages-recoverpw.html" class="text-dark"><b>Reset</b></a></p>
                    </div> -->
                </div>
            </div>
        </div>
    </div>
</body>
</html>