<?php include 'header.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    include '../db/config.php';
    include '../functions/doctors.php';
    $doctor = getDoctorById($id, $conn);
    if ($doctor['image'] == null) {
        $doctor['image'] = '';
    }
    // var_dump($doctor);
}

if (isset($_POST['submit'])) {
    include '../functions/image.php';
    include '../db/config.php';
    $regNo = $_POST['regNo'];
    $name = $_POST['name'];
    $number = $_POST['number'];
    $specialist = $_POST['specialist'];
    $description = $_POST['description'];
    $experience = $_POST['experience'];
    $certificates = $_POST['certificates'];
    $language = $_POST['language'];
    $availability = $_POST['availability'];
    $userId = $_POST['userId'];
    $image= $doctor['image'];
    
    if($_FILES['image']['name'] != ''){
        $target_dir = '../assets/images/uploads/';
        $getimage = image($_FILES['image'], $target_dir);
        if ($getimage != '') {
            $image = $getimage;
        } else {
            echo "<script>alert('Failed to upload image! Image already exited. Please rename and try again')</script>";
        }
    }
    $response = updateDoctor($conn, $id, $regNo, $name, $number, $specialist, $image, $description, $experience, $certificates, $language, $userId, $availability);
    echo "<script>alert('$response'); window.location.href='doctors.php';</script>";
    
    
}
?>

<div class="dashboard-content">
    <div class="card-doctor">
        <!-- <h1>Add New Doctor</h1> -->
        <form id="doctorForm" class="form-grid" method="POST" action="" enctype="multipart/form-data">
            <div class="form-left">
                <div class="form-group">
                    <label for="name">Full Name</label>
                    <input type="text" id="name" placeholder="" value="<?= $doctor['name'] ?>" name="name" required>
                </div>
                <div class="form-group">
                    <label for="experience">Register Number</label>
                    <input type="text" id="regNo" value="<?= $doctor['regNo'] ?>" name="regNo" required>
                </div>
                <div class="form-group">
                    <label for="experience">Contact Number</label>
                    <input type="text" id="number" value="<?= $doctor['number'] ?>" name="number" required>
                </div>
                <div class="form-group">
                    <?php
                    include '../db/config.php';
                    // include '../functions/doctors.php';
                    $specialities = getAllSpecialities($conn);
                    ?>
                    <label for="specialist">Specialization</label>
                    <select class="specialist" name="specialist" required>
                        <option value="<?= $doctor['sId'] ?>" selected><?= $doctor['specialistName'] ?></option>
                        <?php foreach ($specialities as $speciality): ?>
                            <option value="<?= $speciality['id'] ?>"><?= $speciality['name'] ?></option>
                        <?php endforeach; ?>

                    </select>
                </div>
                <div class="form-group">
                    <label for="experience">Years of Experience</label>
                    <input type="text" id="experience" value="<?= $doctor['experience'] ?>" name="experience" required>
                </div>
                <div class="form-group">
                    <label for="language">Languages</label>
                    <input type="text" id="language" value="<?= $doctor['language'] ?>" name="language" required>
                </div>
                <div class="form-group">
                    <label for="userID">User ID (Optional)</label>
                    <input type="text" id="userId" placeholder="1" name="userId" value="<?= $doctor['userId'] ?>">
                </div>
                


            </div>
            <div class="form-right">
                <div class="form-group">
                    <label>Profile Photo</label>
                    <div class="upload-area" id="uploadArea">
                        <div class="upload-content">
                            <div id="imagePreview" class="image-preview">
                                <img id="previewImg" src="../assets/images/uploads/<?= $doctor['image'] ?>" class="upload-icon" width="100" height="100" alt="Doctor Image">
                            </div>
                            <div class="upload-text">
                                <input type="file" id="file-upload" accept="image/*" class="file-input" name="image" onchange="previewFile(event)">
                            </div>
                            <p class="upload-hint">PNG, JPG, GIF (1024*1024)</p>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea id="description" placeholder="" rows="4" name="description" required><?= $doctor['description'] ?></textarea>
                </div>
                <div class="form-group">
                    <label for="certificates">Certificates</label>
                    <textarea id="certificates" name="certificates" rows="3" required><?= $doctor['certificates'] ?></textarea>
                </div>
                <div class="form-group radio-group">
                    <?php if ($doctor['availability'] == 1) {
                        echo '<input type="radio" class="radio" id="available" name="availability" value="1" checked required>';
                        echo '<label for="available">Available</label>';

                        echo '<input type="radio" id="not-available" name="availability" value="0" required>';
                        echo '<label for="not-available">Not Available</label>';
                    } else {
                        echo '<input type="radio" class="radio" id="available" name="availability" value="1"  required>';
                        echo '<label for="available">Available</label>';

                        echo '<input type="radio" id="not-available" name="availability" value="0" checked required>';
                        echo '<label for="not-available">Not Available</label>';
                    }
                    ?>
                </div>

            </div>
            <div class="form-actions">
                <button type="button" class="button button-outline" onclick="history.back()">Cancel</button>
                <button type="submit" class="button button-primary" name="submit">Update</button>
            </div>
        </form>
    </div>
</div>
</div>
<? mysqli_close($conn); ?>
<script>
function previewFile(event) {
    var preview = document.getElementById('previewImg');
    var file = event.target.files[0];
    var reader = new FileReader();

    reader.onload = function(){
        preview.src = reader.result;
    };

    if(file) {
        reader.readAsDataURL(file);
    }
}
</script>
</body>
</html>