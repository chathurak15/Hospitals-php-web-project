<?php
include 'header.php';
include '../db/config.php';
include '../functions/appointment.php';
include '../functions/doctors.php';
include '../functions/patients.php';
include '../functions/user.php';

$appointments = getAllAppointmentCount($conn);
$doctors = getDoctorsCount($conn);
$availableSessions = getAllAvailableSessionCount($conn);

$sql = "SELECT COUNT(*) as total FROM inquiries WHERE status = 'pending'";
$result = mysqli_query($conn, $sql);
$inquiries = mysqli_fetch_assoc($result);
$inquiriesC = $inquiries['total'];

?>
<!-- Main Content -->


<!-- Dashboard Content -->
<div class="dashboard-content">
    <!-- Stats Grid -->
    <div class="stats-grid">
        <div class="stat-card">
            <div class="stat-icon" style="background: #e3f2fd;">
                <i class="fa-solid fa-calendar-check" style="color: #0ea5e9; font-size: 24px;"></i>
            </div>
            <div class="stat-info">
                <p>Total Appointments</p>
                <h3><?= $appointments?></h3>
            </div>
        </div>

        <div class="stat-card">
            <div class="stat-icon" style="background: #e8f5e9;">
                <i class="fa-solid fa-user-doctor" style="color: #22c55e; font-size: 24px;"></i>
            </div>
            <div class="stat-info">
                <p>Total Doctors</p>
                <h3><?= $doctors ?></h3>
            </div>
        </div>

        <div class="stat-card">
            <div class="stat-icon" style="background: #f3e8ff;">
                <i class="fa-solid fa-users" style="color: #a855f7; font-size: 24px;"></i>
            </div>
            <div class="stat-info">
                <p>Available Sessions</p>
                <h3><?= $availableSessions ?></h3>
            </div>
        </div>

        <div class="stat-card">
            <div class="stat-icon" style="background: #fff7ed;">
                <i class="fa-solid fa-clock" style="color: #f97316; font-size: 24px;"></i>
            </div>
            <div class="stat-info">
                <p>Pending Inquiries</p>
                <h3><?= $inquiriesC ?></h3>
            </div>
        </div>
    </div>

        <!-- <div class="stats-grid">
            <div class="stat-card">
                <div class="stat-icon" style="background: #e3f2fd;">
                    <i class='bx bx-pulse' style="color: #0ea5e9;"></i>
                </div>
                <div class="stat-info">
                    <p>Total Appointments</p>
                    <h3><?= $doctor ?></h3>
                </div>
            </div>

            <div class="stat-card">
                <div class="stat-icon" style="background: #e8f5e9;">
                    <i class='bx bx-check-circle' style="color: #22c55e;"></i>
                </div>
                <div class="stat-info">
                    <p>Total Doctors</p>
                    <h3>32</h3>
                </div>
            </div>

            <div class="stat-card">
                <div class="stat-icon" style="background: #f3e8ff;">
                    <i class='bx bx-group' style="color: #a855f7;"></i>
                </div>
                <div class="stat-info">
                    <p>Available Sessions</p>
                    <h3>15</h3>
                </div>
            </div>

            <div class="stat-card">
                <div class="stat-icon" style="background: #fff7ed;">
                    <i class='bx bx-time' style="color: #f97316;"></i>
                </div>
                <div class="stat-info">
                    <p>Pending Inquires</p>
                    <h3>8</h3>
                </div>
            </div>
        </div> -->

        <!-- Recent Patients Table -->
        <div class="patients-table-container">
            <div class="table-header">
                <h2>Recent Appointment</h2>
            </div>
                <table border="1">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Date</th>
                    <th>Time Period</th>
                    <th>Location</th>
                    <th>A.No</th>
                    <th>Doctor Name</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody id="sessionTable">
                <?php
                $appointments = getAllAppointments($conn);
                if($appointments == null){
                    echo "<tr><td colspan='10'>No Appointments Found</td></tr>";
                }
                foreach ($appointments as $appointment) :
                ?>
                    <tr>
                        <td><?=$appointment['id']?></td>
                        <td><?=$appointment['name']?></td>
                        <td><?=$appointment['date']?></td>
                        <td><?=$appointment['time']?></td>
                        <td><?=$appointment['location']?></td>
                        <td><?=$appointment['appointment_No']?></td>
                        <td><?=$appointment['doctor_name']?></td>
                        <td><?=$appointment['status']?></td>
                    </tr>
                <?php endforeach; ?>

            </tbody>
        </table>
            </div>
            
        </div>
    </div>
    </main>
</div>
<!-- <script src="../assets/js/script.js"></script> -->
</body>

</html>