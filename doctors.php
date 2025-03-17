<?php

$doctors = [];
if (isset($_GET['page'])) {
    $end = $_GET['page'] * 12;
    $start = $end - 12;
}else{
    $end = 1 * 12;
    $start = $end - 12;
}

include 'db/config.php';
include 'functions/doctors.php';
$doctors = getDoctorsWithPagination($conn, $start, $end);
include 'db/config.php';
$specialities = getAllSpecialities($conn);

if($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['submit'])) {
    $doctor = $_GET['doctor']??'';
    $speciality = $_GET['speciality']??'';
    $language = $_GET['language']??'';
    $specialityName = $_GET['specialityName']??'';
    $availability = $_GET['availability']??'';

    if (!empty($doctor) || !empty($speciality) || !empty($language)) {

        $conditions = [];
        if (!empty($doctor)) $conditions[] = "d.name LIKE '%$doctor%'";
        if (!empty($language)) $conditions[] = "d.language LIKE '%$language%'";
        if (!empty($speciality)) $conditions[] = "d.specialist = '$speciality'";
        if (!empty($specialityName)) $conditions[] = "s.name LIKE '%$specialityName%'";
        if (!empty($availability)) $conditions[] = "d.availability = '$availability'";
    
        include 'db/config.php';
        $doctors = getDoctorsConditions($conn, $conditions,$start, $end);
        
        if($doctors == null){
            echo '<script>alert("Doctor not Found!"); window.location.href="doctors.php";</script>';
        }
    }
}



?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Doctors</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/doctors.css">
</head>

<body>

    <?php include 'header.php'; ?>

    <!-- doctors -->
    <div class="doctors m-5">
        <div class="container">
            <!-- find a doctor -->
            <div class="find-doctor px-md-3">
                <form class="d-flex  mt-3" action="" method="GET">
                    <input type="text" class="form-control me-md-3" placeholder="Search By Name" name="doctor" >
                    <select class="form-select me-md-3" name="speciality">
                        <option  value="" selected>Select Speciality</option>
                        <?php foreach ($specialities as $speciality) : ?>
                        <option value="<?= $speciality['id'] ?>"><?= $speciality['name'] ?></option>
                        <?php endforeach; ?>
                    </select>
                    <select class="form-select me-md-3" name="location" >
                        <option value="" selected>Select Location</option>
                        <option value="1">Colombo</option>
                        <option value="2">Kandy</option>
                        <option value="3">Kurunagala</option>
                    </select>
                    <select class="form-select me-md-3" name="language">
                        <option value="" selected>Select Language</option>
                        <option value="English">English</option>
                        <option value="Sinhala">Sinhala</option>
                        <option value="Tamil">Tamil</option>
                    </select>
                    <button type="submit" name="submit" value="submit" class="btn-search">Search</button>
                </form>
            </div>

            <div class="d-flex flex-wrap justify-content-center mt-md-5">
                <!-- Doctor Card 1 -->
                <?php
                foreach ($doctors as $doctor):
                    if ($doctor['image'] == null) {
                        $doctor['image'] = 'profile.png';
                    }
                    // var_dump($doctor);
                ?>
                    <div class="doctors-card p-4">
                        <div class="row">
                            <div class="col-md-4 col-sm-12 p-0">
                                <img src="assets/images/uploads/<?= $doctor['image'] ?? 'profile.png' ?>" alt="Doctor" class="doctors-img">
                            </div>
                            <div class="col-md-8 col-sm-12 p-2">
                                <h3 class="doctors-name">Dr.<?= $doctor['name'] ?></h3>
                                <p class="doctors-specialty"><?= $doctor['specialistName'] ?> </p>
                                <p class="doctors-info">
                                    <i class="fa fa-stethoscope me-1"></i><?= $doctor['experience'] . ' ' ?> Experience
                                </p>
                                <p class="doctors-info">
                                    <i class="fa fa-language me-1"></i> <?= $doctor['language'] ?>
                                </p>
                            </div>
                        </div>
                        <hr class="line" />
                        <p class="doctors-info">
                            <i class="fa fa-map-marker-alt me-1"></i> Care Compass Hospital Sri Lanka
                        </p>
                        <p class="doctors-info">
                            <i class="fa fa-graduation-cap me-1"></i><?= $doctor['certificates'] ?>
                        </p>
                        <div class="mt-3 d-flex justify-content-center">
                            <a href="doctor.php?id=<?= $doctor['id'] ?>"><button class="btn btn-profile">Doctor Profile</button></a>
                            <form action="appointment.php" method="post">
                                <input type="hidden" name="doctor" value="<?= $doctor['id'] ?>">
                                <button class="btn btn-appointment" name="search" value="Search">Book Appointment</button>
                            </form>
                        </div>
                    </div>
                <?php endforeach; ?>

            </div>

            <div class="d-flex justify-content-center mt-5">

                <nav aria-label="Page navigation">
                    <ul class="pagination">
                        <?php
                        include 'db/config.php';
                        $total_pages = ceil(getDoctorsCount($conn) / 12);
                        $current_page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
                        $prev_page = max(1, $current_page - 1);
                        $next_page = min($total_pages, $current_page + 1);
                        ?>

                        <!-- Previous Button -->
                        <li class="page-item <?= ($current_page == 1) ? 'disabled' : '' ?>">
                            <a class="page-link" href="doctors.php?page=<?= $prev_page ?>" aria-label="Previous">
                                <span aria-hidden="true">&laquo;</span>
                            </a>
                        </li>

                        <!-- Page Numbers -->
                        <?php for ($i = 1; $i <= $total_pages; $i++) : ?>
                            <li class="page-item <?= ($i == $current_page) ? 'active' : '' ?>">
                                <a class="page-link" href="doctors.php?page=<?= $i ?>"><?= $i ?></a>
                            </li>
                        <?php endfor; ?>

                        <!-- Next Button -->
                        <li class="page-item <?= ($current_page == $total_pages) ? 'disabled' : '' ?>">
                            <a class="page-link" href="doctors.php?page=<?= $next_page ?>" aria-label="Next">
                                <span aria-hidden="true">&raquo;</span>
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>

    <?php include 'footer.php'; ?>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/js/bootstrap.bundle.min.js"></script>
</body>

</html>