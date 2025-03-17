<?php
function islogin(){
    if(isset($_SESSION['loggedin'])){
        return true;
    }
    return false;
}

//add user function admin username = chathura15 | password = 1234
function addUser($conn, $fname, $lname, $email, $username, $password, $role)
{
    $sql = "SELECT * FROM users WHERE email='$email' OR username='$username'";
    $result = mysqli_query($conn, $sql);
    $rows = mysqli_num_rows($result);
    if ($rows > 0) {
        return 'Username or Email already exists';
    };

    $password = password_hash($password, PASSWORD_DEFAULT);
    $sql = "INSERT INTO users (fname, lname, email, username, password, role) VALUES (?,?,?,?,?,?)";
    $stmt = mysqli_prepare($conn, $sql);
    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "sssssi", $fname, $lname, $email, $username, $password, $role);
        if (mysqli_stmt_execute($stmt)) {
            return 'Register successfully';
        }
        return 'Failed to add user';
    }
    mysqli_close($conn);
}

//login function 
function login($email, $password, $conn){
    $sql = "SELECT * FROM users WHERE email='$email' OR username='$email'"; 

    // var_dump($sql);
    $result = mysqli_query($conn, $sql);
    $rows = mysqli_num_rows($result);
    if ($rows == 1) {
        //get user details
        $row = mysqli_fetch_assoc($result);
        if (password_verify($password, $row['password'])) {
            $_SESSION['name'] = $row['fname'] . ' ' . $row['lname'];
            $_SESSION['email'] = $row['email'];
            $_SESSION['role'] = $row['role'];
            $_SESSION['id'] = $row['id'];
            $_SESSION['loggedin'] = true;
            //check user role and redirect to the dashboard
            checklogin();
        }
    } else {
        //return error message
        return 'Invalid email or password';
    }
    return 'Invalid email or password';
    mysqli_close($conn);
}

//check user role, redirect each user to their dashboard
function checklogin()
{
    switch ($_SESSION['role']) {
        case 0:
            header('Location: login.php');
            break;
        case 1:
            header('Location: admin/dashboard.php');
            break;
        case 2:
            header('Location: doctor/appointments.php');
            break;
        default:
            header('Location: login.php');
            break;
    }
}

function getAllUsers($conn, $start, $limit)
{
    $sql = "SELECT id,fname,lname,email,username, role  FROM users WHERE role !=1 ORDER BY id DESC LIMIT $start, $limit";
    $result = mysqli_query($conn, $sql);
    $users = mysqli_fetch_all($result, MYSQLI_ASSOC);

    return $users;
    mysqli_close($conn);
}

function getUserCount($conn)
{
    $sql = "SELECT COUNT(*) FROM users WHERE role !=1";
    $result = mysqli_query($conn, $sql);
    $count = mysqli_fetch_row($result);
    return $count[0];
    mysqli_close($conn);
}

function deleteUser($conn, $id)
{
    $sql = "DELETE FROM users WHERE id=?";
    $stmt = mysqli_prepare($conn, $sql);
    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "i", $id);
        if (mysqli_stmt_execute($stmt)) {
            return 'User deleted successfully';
        }
        return 'Failed to delete user';
    }
    mysqli_close($conn);
}