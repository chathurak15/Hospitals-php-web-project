<?php
session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['role'] != '1') {
    echo "<script>alert('You are not authorized to view this page'); window.location.href='../login.php';</script>";
    exit;
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Care Compass Dashboard</title>
    <link rel="stylesheet" href="../assets/css/users/styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

</head>

<body>
    <div class="container">
        <!-- Sidebar -->
        <aside class="sidebar" id="sidebar">
            <div class="sidebar-header">
                <img src="../assets/images/Care Compass.png" alt="Care Compass Hospital">
                <button id="closeSidebar" class="mobile-only">
                    <i class="fa-solid fa-xmark"></i>
                </button>
            </div>

            <nav class="sidebar-nav">
                <a href="dashboard.php" class="nav-link" data-page="dashboard">
                    <i class="fa-solid fa-house"></i>
                    <span>Dashboard</span>
                </a>
                <a href="appointments.php" class="nav-link" data-page="appointments">
                    <i class="fa-solid fa-calendar-check"></i>
                    <span>Appointments</span>
                </a>

                <a href="sessions.php" class="nav-link" data-page="sessions">
                <i class="fa-solid fa-clipboard-list"></i>
                    <span>Doctor Sessions</span>
                </a>
                
                <a href="specialties.php" class="nav-link" data-page="specialties">
                <i class="fa-solid fa-lightbulb"></i>
                    <span>specialties</span>
                </a>


                <!-- Doctors Dropdown -->
                <div class="nav-dropdown">
                    <button class="nav-link dropdown-toggle">
                        <i class="fa-solid fa-user-doctor"></i> <!-- Doctors Icon -->
                        <span>Doctors</span>
                        <i class="fa-solid fa-chevron-down dropdown-icon"></i>
                    </button>
                    <div class="dropdown-menu">
                        <a href="adddoctor.php" class="dropdown-item" data-page="adddoctor">
                            <i class="fa-solid fa-user-plus"></i> <!-- Add Doctor Icon -->
                            <span>Add Doctor</span>
                        </a>
                        <a href="doctors.php" class="dropdown-item" data-page="doctors">
                            <i class="fa-solid fa-list-ul"></i> <!-- View Doctors Icon -->
                            <span>View Doctors</span>
                        </a>
                    </div>
                </div>
                <a href="Feedbacks.php" class="nav-link" data-page="Feedbacks">
                <i class="fa-solid fa-star"></i>
                    <span>Feedbacks</span>
                </a>

                <a href="inquiries.php" class="nav-link" data-page="inquiries">
                    <i class="fa-solid fa-comments"></i>
                    <span>Inquiries</span>
                </a>
                <a href="users.php" class="nav-link" data-page="users">
                    <i class="fa-solid fa-users"></i>
                    <span>Users</span>
                </a>
            </nav>
        </aside>


        <main class="main-content">
            <!-- Top Navigation -->
            <header class="top-nav">
                <button id="toggleSidebar" class="menu-button">
                    <i class='bx bx-menu'></i>
                </button>
                <div class="nav-right">
                    <button class="notification-btn">
                        <i class='fa fa-bell'></i>
                        <span class="notification-dot"></span>
                    </button>
                    <button class="profile-btn">
                        <i class='fa fa-user-circle'></i>
                        <span><?= $_SESSION['name'] ?></span>
                    </button>

                    <div class="profile-menu">
                        <a href="../logout.php">Logout</a>
                    </div>

                </div>
            </header>
            <script src="../assets/js/script.js"></script>