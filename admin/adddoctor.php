<?php include 'header.php';

if (isset($_POST['submit'])) {
    include '../functions/image.php';
    include '../db/config.php';
    include '../functions/doctors.php';
    $regNo = $_POST['regNo'];
    $name = $_POST['name'];
    $number = $_POST['number'];
    $specialist = $_POST['specialist'];
    $description = $_POST['description'];
    $experience = $_POST['experience'].' Years';
    $certificates = $_POST['certificates'];
    $language = $_POST['language'];
    $availability = $_POST['availability'];
    $userId = $_POST['userId'];
    $image = '';

    if($_FILES['image']['name'] != ''){
        $target_dir = '../assets/images/uploads/';
        $getimage = image($_FILES['image']['name'], $target_dir);
        if ($getimage != '') {
            $image = $image;
        } else {
            echo "<script>alert('Failed to upload image! Image already exited. Please rename and try again')</script>";
        }
    }
   
    $response = addDoctor($conn, $regNo, $name, $number, $specialist, $image, $description, $experience, $certificates, $language, $userId, $availability);
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
                    <input type="text" id="name" placeholder="John Doe" name="name" required>
                </div>
                <div class="form-group">
                    <label for="experience">Register Number</label>
                    <input type="text" id="regNo" placeholder="1001" name="regNo" required>
                </div>
                <div class="form-group">
                    <label for="experience">Contact Number</label>
                    <input type="text" id="number" placeholder="+94789362885" name="number" required>
                </div>
                <div class="form-group">
                        <?php
                        include '../db/config.php';
                        include '../functions/doctors.php';
                        $specialities = getAllSpecialities($conn); 
                        ?>
                    <label for="specialist">Specialization</label>
                    <select class="specialist" name="specialist" required>
                        <option value="" selected>Select Specialization</option>
                        <?php foreach ($specialities as $speciality): ?>
                            <option value="<?= $speciality['id'] ?>"><?= $speciality['name'] ?></option>
                        <?php endforeach; ?>
                        
                    </select>
                </div>
                <div class="form-group">
                    <label for="experience">Years of Experience</label>
                    <input type="number" id="experience" placeholder="10" name="experience" required>
                </div>
                <div class="form-group">
                    <label for="language">Languages</label>
                    <input type="text" id="language" placeholder="English, Sinhala" name="language" required>
                </div>
            
                <div class="form-group">
                    <label for="userID">User ID (Optional)</label>
                    <input type="number" id="userId" placeholder="1" name="userId" >
                </div>
                


            </div>
            <div class="form-right">
                <div class="form-group">
                    <label>Profile Photo</label>
                    <div class="upload-area" id="uploadArea">
                        <div class="upload-content">
                            <div id="imagePreview" class="image-preview">
                                <svg class="upload-icon" width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                                    <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                                    <polyline points="17 8 12 3 7 8"></polyline>
                                    <line x1="12" y1="3" x2="12" y2="15"></line>
                                </svg>
                            </div>
                            <div class="upload-text">
                                <!-- <label for="file-upload" class="file-label">Upload a file</label> -->
                                <input type="file" id="file-upload" accept="image/*"  class="file-input" name="image">
                            </div>
                            <p class="upload-hint">PNG, JPG, GIF (1024*1024)</p>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea id="description" placeholder="Enter doctor's bio and achievements" rows="4" name="description" required></textarea>
                </div>
                <div class="form-group">
                    <label for="certificates">Certificates</label>
                    <textarea id="certificates" name="certificates" placeholder="MBBS ,MD" rows="3" required></textarea>
                </div>
                <div class="form-group radio-group">
                    <input type="radio" class="radio" id="available" name="availability" value="1" checked required>
                    <label for="available">Available</label>

                    <input type="radio" id="not-available" name="availability" value="0" required>
                    <label for="not-available">Not Available</label>
                </div>

            </div>
            <div class="form-actions">
                <button type="button" class="button button-outline" onclick="history.back()">Cancel</button>
                <button type="submit" class="button button-primary" name="submit">Add Doctor</button>
            </div>
        </form>
    </div>
</div>
</div>
<? mysqli_close($conn); ?>
</body>

</html>