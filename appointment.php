<?php

include 'db/config.php';
include 'functions/doctors.php';
include 'functions/appointment.php';
$doctors = getDoctors($conn);
$error = '';

if (isset($_POST['search'])) {
    $doctor = $_POST['doctor'] ?? '';
    $location = $_POST['location'] ?? '';
    $specialization = $_POST['specialization'] ?? '';
    $date = $_POST['date'] ?? '';
    if ($doctor || $location || $specialization || $date) {

        $conditions = [];
        if (!empty($doctor)) $conditions[] = "doctorID = '$doctor'";
        if (!empty($location)) $conditions[] = "location = '$location'";
        if (!empty($specialization)) $conditions[] = "SpecialtyID = '$specialization'";
        if (!empty($date)) $conditions[] = "date = '$date'";

        include 'db/config.php';
        $sessions = searchSessions($conn, $conditions);

        $name = '';
        if ($doctor) {
            $doctorname = getDoctorById($doctor, $conn);
            $name = ' Dr.' . $doctorname['name'];
        }

        if (count($sessions) > 0) {
            $error = count($sessions) . ' results found';
            echo '<style>.search { display: none !important; }</style>';
            echo '<style>.doctorSessions { display: block !important; }</style>';
        } else {
            $error = 'Not found an Session for ' . $name . " " . $location . " " . $date;
        }
    } else {
        $error = 'Please select minimum one field';
    }
}

if (isset($_GET['doctorId'])) {
    $error = 'Select Your time slot and book your appointment';
    include 'db/config.php';
    $id = $_GET['doctorId'];
    $Date = $_GET['date'] ?? '';
    $aDoctor = getDoctorById($id, $conn);
    include 'db/config.php';
    $dSessions = getSessionsByDoctorId($conn, $id, $Date);
    echo '<style>.doctor { display: block !important; }</style>';
    echo '<style>.search { display: none !important; }</style>';
    echo '<style>.doctorSessions { display: none !important; }</style>';
}
if (isset($_GET['sessionID'])) {
    $error = 'Please fill the form to book your appointment';
    include 'db/config.php';
    $id = $_GET['sessionID'];
    $doctorId = $_GET['doctorID'];
    $session = getSessionById($id, $conn);
    echo '<style>.Patient { display: block !important; }</style>';
    echo '<style>.doctor { display: none !important; }</style>';
    echo '<style>.search { display: none !important; }</style>';

    // var_dump($id);
}

if (isset($_POST['appointment'])) {
    $sessionID = $_POST['sessionID'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $number = $_POST['number'];
    $age = $_POST['age'];
    $NIC = $_POST['NIC'];
    $cardNumber = $_POST['cardNumber'];
    $expDate = $_POST['expDate'];
    $cvv = $_POST['cvv'];


    if ($name == '' || $number == '' || $age == '' || $NIC == '' || $cardNumber == '' || $expDate == '' || $cvv == '') {
        $error = 'Please fill all required fields';
    } else {
        include 'db/config.php';
        $response = addAppointment($conn, $sessionID, $number, $age, $NIC, $email, $name, $cardNumber, $expDate, $cvv);
        if ($response == 1) {
            $error = 'This session is not available for appointments at the moment due to session Expired or Full';
        } else {
            echo "<script>alert('$response'); window.location.href='appointment.php';</script>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Appointment</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/appointment.css">

</head>

<body>
    <?php include 'header.php'; ?>
    <!-- Hero Section -->
    <div class="hero-image">
        <div class="container">
            <div class="appointment">
                <section class="hero">
                    <span class="badge">Book Your Visit Today</span>
                    <h1>Expert Medical Care,<br>Just a Click Away</h1>
                    <p>Schedule appointments with top doctors in your area.<br>No waiting rooms, no hassle.</p>
                    <a href="checkAppointment.php" class="btn-book">Check Your Appointment Status!</a>
                </section>

                <!-- Appointment Form -->
                <section class="appointment-form" id="appointmentForm">
                    <h2 class="section-title">Book Your Appointment</h2>
                    <p class="mg"><?= $error ?></p>
                    
                    <form id="search" method="post" class="search" style="display: block;">
                        <div class="form-group">
                            <select id="doctor" name="doctor">
                                <option value="">Select a doctor</option>
                                <?php foreach ($doctors as $doctor) : ?>
                                    <option value="<?= $doctor['id'] ?>">Dr. <?= $doctor['name'] . ' - ' . $doctor['certificates'] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <select id="location" name="location">
                                <option value="">Select Our Hospital Location</option>
                                <option value="Colombo">Colombo</option>
                                <option value="Kandy">Kandy</option>
                                <option value="Kurunagala">Kurunagala</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <select id="specialization" name="specialization">
                                <option value="">Any Specialization</option>
                                <?php
                                include 'db/config.php';
                                $specialities = getAllSpecialities($conn);
                                foreach ($specialities as $speciality) : ?>
                                    <option value="<?= $speciality['id'] ?>"><?= $speciality['name'] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <input type="date" id="date" name="date">
                        </div>
                        <button type="search" class="btn" name="search" value="search">Search</button>
                    </form>

                    <!-- Section to display available sessions -->
                    <div id="doctorSessions" class="doctorSessions" style="display: none;">
                        <?php if (isset($sessions)) : ?>
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Doctor</th>
                                        <th>Location</th>
                                        <th>Date</th>
                                        <th>Specialty</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($sessions as $session) :
                                        include 'db/config.php';
                                        $doctor = getDoctorById($session['doctorID'], $conn);
                                    ?>
                                        <tr>
                                            <td>Dr.<?= $doctor['name'] ?></td>
                                            <td><?= $session['location'] ?></td>
                                            <td><?= $session['date'] ?></td>
                                            <td><?= $doctor['specialistName'] ?></td>
                                            <td>
                                                <a href="?doctorId=<?= $doctor['id'] ?>&date=<?= $session['date'] ?>&location=<?= $session['location'] ?>" class="btn-book">View</a>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        <?php endif; ?>
                        <a href=""><button class="btn">Go Back</button></a>
                    </div>

                    <div class="doctor" style="display: none;">
                        <div class="d-flex flex-wrap justify-content-center">
                            <!-- Doctor Card 1 -->
                            <div class="doctors-card p-4">
                                <img src="assets/images/uploads/<?= $aDoctor['image'] ?>" alt="Doctor" class="doctors-img">
                                <h3 class="doctors-name">Dr.<?= $aDoctor['name'] ?></h3>
                                <p class="doctors-specialty"> <?= $aDoctor['specialistName'] ?></p>
                                <p class="doctors-info">
                                    <i class="fa fa-stethoscope me-1"></i><?= $aDoctor['experience'] . ' ' ?> Experience
                                </p>
                                <p class="doctors-info">
                                    <i class="fa fa-graduation-cap me-1"></i><?= $aDoctor['certificates'] ?>
                                </p>
                                <p class="doctors-info">
                                    <i class="fa fa-location me-1"></i><?= $_GET['location'] ?>
                                </p>
                            </div>
                        </div>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Date</th>
                                    <th>Time</th>
                                    <th>Active Appointments</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($dSessions as $dSession) :
                                    include 'db/config.php';
                                    // $doctor = getDoctorById($dSession['doctorID'], $conn);
                                ?>
                                    <tr>
                                        <td><?= $dSession['date'] ?></td>
                                        <td><?= $dSession['timePeriod'] ?></td>
                                        <td><?= $dSession['appointmentCount'] ?> <span class="book-action">Status : <?= $dSession['status'] ?></span></td>
                                        <td>
                                            <?php if($dSession['status'] !='Active'){?>
                                                <a href="#" class="disabled-link">Book</a>
                                            <?php } else { ?>
                                                <a href="?sessionID=<?= $dSession['id'] ?>&doctorID=<?= $dSession['doctorID'] ?>" class="btn-book" id="btn-book">Book</a>
                                            <?php } ?>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                        <a href="appointment.php"><button class="btn" >Go Back</button></a>
                    </div>

                    <div class="Patient" style="display: none;">
                        <!-- <?= var_dump($session); ?> -->
                        <form id="patientForm" class="form-grid" method="POST" action="">
                            <div class="form-group">
                                <label for="name">Full Name</label>
                                <input type="text" id="name" placeholder="Eg: Chathura kavindu" name="name">
                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" id="email" placeholder="Email (Optional)" name="email">
                            </div>
                            <div class="form-group">
                                <label for="number">Contact Number</label>
                                <input type="text" id="number" placeholder="Eg: +94789362885" name="number">
                            </div>
                            <div class="form-group">
                                <label for="age">Age</label>
                                <input type="number" id="age" placeholder="Eg: 21" name="age">
                            </div>
                            <div class="form-group">
                                <label for="NIC">NIC</label>
                                <input type="text" id="NIC" placeholder="Eg: 200401500019" name="NIC">
                            </div>
                            <div class="form-group">
                                <label for="address">Doctor Name(Can't edit this step)</label>
                                <input type="text" id="address" placeholder="Doctor Name - Location" name="address" value="Dr. <?= $session['name'] ?>" readonly>
                            </div>

                            <div class="form-group">
                                <p class="info"><i class="fa-solid fa-calendar-days"></i> Date : <?= $session['date'] ?></p>
                                <p class="info"><i class="fa-solid fa-clock"></i> Time : <?= $session['timePeriod'] ?></p>
                                <p class="info"><i class="fa-solid fa-map-marker-alt"></i> Location : <?= $session['location'] ?></p>
                                <p class="info"><i class="fa-solid fa-money-bill-wave"></i> Charges: LKR <?= $session['charges'] ?></p>
                                <p class="info"><i class="fa-solid fa-user"></i> Your Appointment number: <?= $session['appointmentCount'] + 1 ?></p>
                            </div>
                            <div class="form-group">
                                <div class="form-group">
                                    <input type="text" name="cardNumber" placeholder="Enter Card Number" id="cardNumber">
                                </div>
                                <div class="form-group">
                                    <input type="text" name="expDate" placeholder="Enter Expiry Date" id="expDate">
                                </div>
                                <div class="form-group">
                                    <input type="text" name="cvv" placeholder="Enter CVV" id="cvv">
                                </div>
                            </div>

                            <div class="form-group">
                                <a href="?doctorId=<?= $doctorId ?>&date=<?= $session['date'] ?>&location=<?= $session['location'] ?>" class="btn">Back</a>
                            </div>

                            <div class="form-group">
                                <input type="hidden" name="sessionID" value="<?= $session['id'] ?>">
                                <button type="submit" name="appointment" class="btn">Book Appointment</button>
                            </div>

                        </form>
                    </div>

                </section>
            </div>

        </div>

    </div>
    <?php include 'footer.php'; ?>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/js/bootstrap.bundle.min.js"></script>

    <script>
        function goBack() {
            document.getElementById("search").style.display = "none !important";
            document.getElementById("doctorSessions").style.display = "block !important";
            document.getElementById("doctor").style.display = "none !important";
        }
    </script>

</body>

</html>