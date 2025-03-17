<?php
include 'header.php';
include '../db/config.php';
include '../functions/appointment.php';

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $doctor_id = $_POST['doctor_id'];
    $date = $_POST['date'];
    $time_period = $_POST['time_period'];
    $location = $_POST['location'];
    $count = $_POST['max_seats'];
    $charges = $_POST['charges'];
    $response = addSession($conn, $date, $time_period, $location, $count, $doctor_id, $charges);
    echo "<script>alert('$response'); window.location.href='sessions.php';</script>";
    exit();
}
if(isset($_GET['delete'])){
    $id = $_GET['delete'];
    $response = deleteSession($conn, $id);
    echo "<script>alert('$response'); window.location.href='sessions.php';</script>";
    exit();
}
?>


<!-- Search Bar -->
<div class="dashboard-content">
<div class="card-body">
    <div class="search-bar">
        <input type="text" id="searchInput" placeholder="Search by Doctor, Date, or Location" onkeyup="searchSession()">
        <button class="btn-primary" onclick="openModal()">Add New Session</button>
    </div>

    <!-- Popup Form -->
    <div id="sessionModal" class="modal">
        <div class="modal-content">
            <span class="close-btn" onclick="closeModal()">&times;</span>
            <h2 class="addnewtitle">Add New Session</h2>
            <form id="sessionForm" action="" method="POST">

            
            <?php
            include '../functions/doctors.php';
            $doctors = getAvailableDoctors($conn);
            ?>
                <select class="add-group" id="doctor_id" name="doctor_id">
                    <option value="">Select Doctor</option>
                    <?php foreach ($doctors as $doctor): ?>
                        <option value="<?= $doctor['id'] ?>"><?= $doctor['regNo'].' - Dr.'.$doctor['name'].'('. $doctor['certificates'].')' ?></option>
                    <?php endforeach; ?>
                </select>
                <input type="date" class="add-group" id="date" name="date" >
                <select id="time_period" class="add-group" name="time_period">
                    <option value="">Select Time Period</option>
                    <option value="6:00 AM - 8:00 AM">6:00 AM - 8:00 AM</option>
                    <option value="4:00 PM - 6:00 PM">4:00 PM - 6:00 PM</option>
                    <option value="5:00 PM - 7:00 PM">6:00 PM - 7:00 PM</option>
                    <option value="7:00 PM - 8:00 PM">7:00 PM - 8:00 PM</option>
                    <option value="8:00 PM - 9:00 PM">8:00 PM - 9:00 PM</option>
                </select>
                <select id="location" class="add-group" name="location">
                    <option value="">Select Location</option>
                    <option value="Colombo">Colombo</option>
                    <option value="Kandy">Kandy</option>
                    <option value="Kurunagala">Kurunagala</option>
                </select>
                <input type="number" class="add-group" id="max_seats" name="max_seats" placeholder="Max Seats">
                <input type="number" class="add-group" id="charges" name="charges" placeholder="Charges - LKR">
                <button type="submit" class="btn success">Add Session</button>
            </form>
        </div>
    </div>

    <!-- Sessions Table -->
    <table border="1">
        <thead>
            <tr>
                <th>Session ID</th>
                <th>Doctor Name</th>
                <th>Date</th>
                <th>Time Period</th>
                <th>Location</th>
                <th>Max Slot</th>
                <th>Complete</th>
                <th>Status</th>
                <th>charges</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody id="sessionTable">
            <?php
            include '../db/config.php';
            $sessions = getSessions($conn);
            if($sessions == null){
                echo "<tr><td colspan='10'>No Sessions Found</td></tr>";
            }
            foreach ($sessions as $session):
            ?>
            <tr>
                <td><?=$session['id']?></td>
                <td>Dr. <?=$session['name']?></td>
                <td><?=$session['date']?></td>
                <td><?=$session['timePeriod']?></td>
                <td><?=$session['location']?></td>
                <td><?=$session['count']?></td>
                <td><?=$session['appointmentCount']?></td>
                <td><?=$session['status']?></td>
                <td><?=$session['charges']?></td>
                <td>
                    <a href="updateSessions.php?id=<?=$session['id']?>" class="edit-btn"><i class="fas fa-edit"></i>Edit</a>
                    <a href="?delete=<?=$session['id']?>" class="delete-btn" onclick="return confirm('Are you sure you want to delete this Session?')">
                    <i class="fas fa-trash-alt"></i></a>
                </td>
            </tr>
            <?php endforeach; ?>

        </tbody>
    </table>
</div>
</div>
<?php mysqli_close($conn); ?>

<script>
    function searchSession() {
        let input = document.getElementById("searchInput").value.toLowerCase();
        let rows = document.getElementById("sessionTable").getElementsByTagName("tr");

        for (let row of rows) {
            let text = row.textContent.toLowerCase();
            row.style.display = text.includes(input) ? "" : "none";
        }
    }

    // Open Modal
    function openModal() {
        document.getElementById("sessionModal").style.display = "flex";
    }

    // Close Modal
    function closeModal() {
        document.getElementById("sessionModal").style.display = "none";
    }

    // Close Modal When Clicking Outside
    window.onclick = function(event) {
        let modal = document.getElementById("sessionModal");
        if (event.target === modal) {
            closeModal();
        }
    }

    // Handle Form Submission (Demo)
    // document.getElementById("sessionForm").addEventListener("submit", function(event) {
    //     event.preventDefault();
    //     alert("New session added successfully!");
    //     closeModal();
    // });
</script>

</body>

</html>