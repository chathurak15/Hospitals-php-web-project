<?php
session_start();
if (!isset($_SESSION['loggedin']) && $_SESSION['role'] != 2) {
    header('Location: ../login.php');
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
    <link rel="stylesheet" href="../assets/css/doctors.css">
    </link>

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
                <!-- <a href="dashboard.php" class="nav-link" data-page="dashboard">
                    <i class="fa-solid fa-house"></i>
                    <span>Dashboard</span>
                </a> -->
                <a href="appointments.php" class="nav-link" data-page="appointments">
                    <i class="fa-solid fa-calendar-check"></i>
                    <span>Appointments</span>
                </a>

                <a href="sessions.php" class="nav-link" data-page="sessions">
                    <i class="fa-solid fa-clipboard-list"></i>
                    <span>Your Sessions</span>
                </a>

                <a href="profile.php" class="nav-link" data-page="profile">
                    <i class="fa-solid fa-users"></i>
                    <span>Profile</span>
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
                    <!-- <div class="search-box">
                        <i class='bx bx-search'></i>
                        <input type="search" placeholder="Search...">
                    </div> -->
                    <button class="notification-btn">
                        <i class='bx bx-bell'></i>
                        <span class="notification-dot"></span>
                    </button>
                    <button class="profile-btn">
                        <i class='bx bx-user-circle'></i>
                        <span>Dr.<?= $_SESSION['name'] ?></span>
                    </button>

                    <div class="profile-menu">
                        <a href="../logout.php">Logout</a>
                    </div>

                </div>
            </header>
            <script src="../assets/js/script.js"></script>