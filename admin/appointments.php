<?php
include 'header.php';
include '../db/config.php';
include '../functions/appointment.php';

if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $response = deleteAppointment($conn, $id);
    // echo "<script>alert('$response'); window.location.href='/admin/appointments.php';</script>";
    // exit();
}

if(isset($_POST['status'])){
    // include '../db/config.php';
    $status = $_POST['status'];
    $id = $_POST['id'];
    $response = updateAppointmentStatus($conn, $id, $status);
    echo "<script>alert('$response'); window.location.href='appointments.php';</script>";
    exit();
}

?>


<!-- Search Bar -->
<div class="dashboard-content" id="dashboard-content">
    <div class="card-body">
        <div class="search-bar">
            <input type="text" id="searchInput" placeholder="Search by Name,ID, Date, or Number" onkeyup="searchSession()">
        </div>

        <!-- Appointment table -->
        <table border="1">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Number</th>
                    <th>Date</th>
                    <th>Time Period</th>
                    <th>Location</th>
                    <th>A.No</th>
                    <th>Doctor Name</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody id="sessionTable">
                <?php
                include '../db/config.php';
                $appointments = getAllAppointments($conn);
                if($appointments == null){
                    echo "<tr><td colspan='10'>No Appointments Found</td></tr>";
                }
                foreach ($appointments as $appointment) :
                ?>
                <form action="" method="post" onsubmit="return confirmSubmit(this);">
                    <tr>
                        <td><?=$appointment['id']?></td>
                        <td><?=$appointment['name']?></td>
                        <td><?=$appointment['mobile_number']?></td>
                        <td><?=$appointment['date']?></td>
                        <td><?=$appointment['time']?></td>
                        <td><?=$appointment['location']?></td>
                        <td><?=$appointment['appointment_No']?></td>
                        <td><?=$appointment['doctor_name']?></td>
                        
                        <input type="text" name="id" value="<?= $appointment['id'] ?>" hidden>
                        <td>
                            <select class="form-select" name="status"  onchange="confirmChange(this)">
                                <option value="<?=$appointment['status']?>" selected><?=$appointment['status']?></option>
                                <option value="Pending">Pending</option>
                                <option value="Approved">Approved</option>
                                <option value="Reject">Canceled</option>
                            </select>
                        </td>

                        <td>
                            <a href="" class="edit-btn"><i class="fas fa-eye"></i></a>
                            <a href="?delete=<?=$appointment['id']?>" class="delete-btn" onclick="return confirm('Are you sure you want to delete this appointment?')">
                                <i class="fas fa-trash-alt"></i></a>
                        </td>
                    </tr>
                </form>
                <?php endforeach; ?>

            </tbody>
        </table>
    </div>
</div>
<script>
    function confirmChange(selectElement) {
        let selectedStatus = selectElement.value;
        let confirmation = confirm("Are you sure you want to change the status to '" + selectedStatus + "'?");

        if (confirmation) {
            selectElement.form.submit();
        }
        // } else {
        //     selectElement.value = "<?= $appointment['status'] ?>";
        // }
    }
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