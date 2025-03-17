<?php
include 'header.php';
include '../db/config.php';
include '../functions/appointment.php';
include '../functions/doctors.php';
$doctor = getDoctorByUserId($conn, $_SESSION['id']);
if($doctor == null){
    echo "<script>alert('Your Account is under review. Please contact the Administrator!'); window.location.href='';</script>";
    exit();
}
?>


<!-- Search Bar -->
<div class="dashboard-content">
<div class="card-body">
    <div class="search-bar">
        <input type="text" id="searchInput" placeholder="Search by Doctor, Date, or Location" onkeyup="searchSession()">
    </div>

    <!-- Sessions Table -->
    <table border="1">
        <thead>
            <tr>
                <th>Session ID</th>
                <th>Date</th>
                <th>Time Period</th>
                <th>Location</th>
                <th>Max Seats</th>
                <th>Complete</th>
                <th>Status</th>
                <th>charges</th>
            </tr>
        </thead>
        <tbody id="sessionTable">
            <?php
            include '../db/config.php';
            $sessions = getDoctorSessions($conn, $doctor['id']);
            if($sessions == null){
                echo "<tr><td colspan='10'>No Sessions Found</td></tr>";
            }
            foreach ($sessions as $session):
            ?>
            <tr>
                <td><?=$session['id']?></td>
                <td><?=$session['date']?></td>
                <td><?=$session['timePeriod']?></td>
                <td><?=$session['location']?></td>
                <td><?=$session['count']?></td>
                <td><?=$session['appointmentCount']?></td>
                <td><?=$session['status']?></td>
                <td><?=$session['charges']?></td>
    
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
   
</script>

</body>

</html>