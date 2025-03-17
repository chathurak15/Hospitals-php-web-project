<?php
include 'header.php';
include '../db/config.php';
include '../functions/doctors.php';
include '../functions/appointment.php';

$doctor = getDoctorByUserId($conn, $_SESSION['id']);
if($doctor == null){
    echo "<script>alert('Your Account is under review. Please contact the Administrator! 0112435852'); window.location.href='../index.php';</script>";
    exit();
}

?>


<!-- Search Bar -->
<div class="dashboard-content">
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
                    <th>Age</th>
                    <th>Date</th>
                    <th>Time Period</th>
                    <th>Location</th>
                    <th>A.No</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody id="sessionTable">
                <?php
                if (isset($_GET['page'])) {
                    $end = $_GET['page'] * 25;
                    $start = $end - 25;
                } else {
                    $end = 1 * 25;
                    $start = $end - 25;
                }
                include '../db/config.php';
                $appointments= getDoctorAppointments($conn, $doctor['id'], $start, $end);
                if($appointments == null){
                    echo "<tr><td colspan='10'>No Appointments Found</td></tr>";
                }
                foreach ($appointments as $appointment) :
                ?>
                    <tr>
                        <td><?=$appointment['id']?></td>
                        <td><?=$appointment['name']?></td>
                        <td><?=$appointment['age']?></td>
                        <td><?=$appointment['date']?></td>
                        <td><?=$appointment['time']?></td>
                        <td><?=$appointment['location']?></td>
                        <td><?=$appointment['appointment_No']?></td>
                        <td><?=$appointment['status']?></td>

                        <td>
                            <a href="/doctor.php?id=<?=$appointment['id']?>" class="edit-btn"><i class="fas fa-eye"></i>Print</a>
                        </td>
                    </tr>
                <?php endforeach; ?>

            </tbody>
        </table>

        <div class="d-flex">
            <nav aria-label="Page navigation">
                <ul class="pagination">
                    <?php
                    include '../db/config.php';
                    $total_pages = ceil(getDoctorAppointmentsCount($conn,$doctor['id']) / 25);
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