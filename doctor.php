<?php
if (!isset($_GET['id'])) {
    header('Location: doctors.php');
}

include 'db/config.php';
include 'functions/patients.php';
include 'functions/appointment.php';
$sessions = getDoctorSessions($conn, $_GET['id']);
$feedbacks = getAllApprovedFeedbacks($conn, 0, 3);

include 'db/config.php';
include 'functions/doctors.php';
$id = $_GET['id'];
$doctor = getDoctorById($id, $conn);
// var_dump($doctor);
if ($doctor['image'] == null) {
    $doctor['image'] = 'profile.png';
}

if (isset($doctor['error'])) {
    echo $doctor['error'];
    header('Location: doctors.php');
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Doctor Profile</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/doctors.css">
</head>

<body>
    <?php include 'header.php'; ?>

    <!-- Breadcrumb -->
    <div class="breadcrumb bg">
        <div class="container">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-items"><a href="home.html">Home > </a></li>
                    <li class="breadcrumb-items"><a href="doctors.html">Doctors > </a></li>
                    <li class="breadcrumb-items active" aria-current="page">Doctor Profile</li>
                </ol>
            </nav>
            <h3 class="doctor-name">Dr.<?= $doctor['name'] ?? '' ?></h3>
        </div>
    </div>

    <div class="container">
        <div class="profile-grid">
            <!-- Profile Section -->
            <div class="profile-content mb-4">
                <div class="cover-image">
                    <img src="assets/images/host.jpg" alt="Hospital">
                    <div class="profile-image">
                        <img src="assets/images/uploads/<?= $doctor['image'] ?? 'doctor2.jpg' ?>" alt="Dr. Chathura Kavindu">
                    </div>
                </div>

                <div class="profile-info">
                    <div class="d-flex">
                        <div class="col-md-8 col-sm-12">
                            <h2>Dr. <?= $doctor['name'] ?? '' ?></h2>
                            <p class="specialty"><?= $doctor['specialistName'] ?></p>
                            <form action="appointment.php" method="post">
                                <input type="hidden" name="doctor" value="<?= $doctor['id'] ?>">
                                <button class="book-btn" name="search" value="Search">Book Appointment</button>
                            </form>
                        </div>

                        <div class="col-md-4 col-sm-12 hospital-info">
                            <p>Care Complex Hospital,</p>
                            <!-- <p><?= $doctor['location'] ?></p> -->

                        </div>
                    </div>


                    <div class="tabs">
                        <div class="tab-buttons">
                            <button class="tab-btn active" data-tab="profile">Profile</button>
                            <button class="tab-btn" data-tab="expertise">Expertise</button>
                            <button class="tab-btn" data-tab="certificates">Certificates/Other</button>
                        </div>

                        <div class="tab-content active" id="profile">
                            <p><?= $doctor['description'] ?? '' ?></p>
                        </div>
                        <div class="tab-content" id="expertise">
                            <p><?= $doctor['experience'] ?? '' ?> Experience </p>
                        </div>
                        <div class="tab-content" id="certificates">
                            <p><?= $doctor['certificates'] ?? '' ?> </p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Booking Section -->
            <div class="">
                <div class="booking-section">
                    <h3>Booking Availability</h3>

                    <div id="doctorSessions" class="doctorSessions">
                        <?php if ($sessions != null) : ?>
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Location</th>
                                        <th>Date</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($sessions as $session) :
                                        if ($session['status'] != 'Expired') :
                                    ?>
                                            <tr>
                                                <td><?= $session['location'] ?></td>
                                                <td><?= $session['date'] ?></td>
                                                <td>
                                                    <a href="appointment.php?doctorId=<?= $doctor['id'] ?>&date=<?= $session['date'] ?>&location=<?= $session['location'] ?>" class="btn-book">View</a>
                                                </td>
                                            </tr>
                                    <?php endif;
                                    endforeach; ?>
                                </tbody>
                            </table>
                        <?php else : ?>
                            <p class="doctor-name" style="text-align:center; font-size: 15px; margin: 10px;">No Sessions Found this time!</p>
                        <?php endif; ?>
                    </div>

                </div>

            </div>
        </div>
    </div>

    <section class="feedback mt-5 mb-5">
        <div class="container mt-5 mb-4">
            <h3 class="feedback-title text-center">Inspiring <span class="feedback-sub">Stories!</span></h3>
            <div class="carousel-containe mt-4">
                <div class="carousel-track raw justify-content-center">
                    <!-- feedback Card 1 -->
                    <?php foreach ($feedbacks as $feedback):
                        if ($feedback['image'] == null) {
                            $feedback['image'] = 'profile.png';
                        }
                    ?>
                        <div class="col-md-4 col-sm-12 feedback-card p-4 ">
                            <div class="row align-items-center">
                                <div class="col-md-3 col-sm-6 p-0 ps-3">
                                    <img src="assets/images/uploads/patients/<?= $feedback['image'] ?>" alt="Doctor" class="feedback-img">
                                </div>
                                <div class="col-md-8 col-sm-6 p-4">
                                    <h3 class="pname m-0"><?= $feedback['name'] ?></h3>
                                    <p class="pBranch mt-1"><?= $feedback['location'] ?></p>
                                </div>
                            </div>
                            <div class="feedback-info">
                                <p class="feedback-description mt-0"><?= $feedback['message'] ?></p>
                            </div>
                        </div>
                    <?php endforeach; ?>

                </div>
            </div>

        </div>
    </section>

    <?php include 'footer.php'; ?>


    <script src="assets/js/script.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/js/bootstrap.bundle.min.js"></script>
</body>

</html>