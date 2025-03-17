<?php
include 'header.php';
include '../db/config.php';
include '../functions/doctors.php';

$doctor = getDoctorByUserId($conn, $_SESSION['id']);


?>

<style rel="stylesheet" href="../assets/css/doctors.css" ></style>
<div class="dashboard-content">
    <div class="profile-content mb-4">
        <div class="cover-image">
            <img src="../assets/images/doc_bg.png" alt="Hospital">
            <div class="profile-image">
                <img src="../assets/images/uploads/<?= $doctor['image'] ?? 'doctor2.jpg' ?>" alt="Dr. Chathura Kavindu">
            </div>
        </div>

        <div class="profile-info">
            <div class="d-flex">
                <div class="col-md-8 col-sm-12">
                    <h2>Dr. <?= $doctor['name'] ?? '' ?></h2>
                    <!-- <p class="specialty"><?= $doctor['specialistName'] ?></p> -->
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
</div>
</body>

</html>