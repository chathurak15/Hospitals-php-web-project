<?php include 'header.php';
include '../db/config.php';
include '../functions/doctors.php';

if (isset($_GET['delete'])) {
    $response = deleteDoctor($conn, $_GET['delete']);
    echo "<script>alert('$response'); window.location.href='doctors.php';</script>";
    exit();
}
?>

<div class="dashboard-content">
    <div class="card-body">

        <div class="search-bar">
            <input type="text" id="searchInput" placeholder="Search by Doctor, Date, or Location" onkeyup="searchSession()">
            <a href="adddoctor.php " class="btn-primary" style="display: inline-block; width: 200px; text-decoration:none; height: 40px; text-align: center; line-height: 40px; ">Add Doctor</a>

        </div>
        <div id="datatable-buttons_wrapper" class="dataTables_wrapper dt-bootstrap5 no-footer">
            <div class="row">
                <div class="col-sm-12">
                    <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap" style="width: 100%;">
                        <thead>
                            <tr>
                                <th>RegID</th>
                                <th>Image</th>
                                <th>Name</th>
                                <th>Phone Number</th>
                                <th>Speciality</th>
                                <th>Locations</th>
                                <th>Availability</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody class="index" id="index">
                            <tr class="align-middle">
                                <?php
                                if (isset($_GET['page'])) {
                                    $end = $_GET['page'] * 7;
                                    $start = $end - 7;
                                } else {
                                    $end = 1 * 7;
                                    $start = $end - 7;
                                }

                                $doctors = getDoctorsWithPagination($conn, $start, $end);
                                if ($doctors == null) {
                                    echo "<tr><td colspan='8'>No Doctors Found</td></tr>";
                                }
                                foreach ($doctors as $doctor):
                                    if ($doctor['image'] == null) {
                                        $doctor['image'] = 'profile.png';
                                    }
                                    include '../db/config.php';
                                    $specialities = getSpecialitiesById($doctor['specialist'], $conn);
                                ?>

                                    <td class="doctorname"><?= $doctor['regNo'] ?></td>
                                    <td><img class='profile-img' src="../assets/images/uploads/<?= $doctor['image'] ?? 'doctor2.jpg' ?>"></td>
                                    <td class="doctorname"><a class="name" href=""></a> Dr. <?= $doctor['name'] ?></td>
                                    <td><?= $doctor['number'] ?></td>
                                    <td><?= $specialities ?>
                                    </td>
                                    <td>Colombo, Kandy</td>
                                    <td>
                                    <?php 
                                        if($doctor['availability']==1){
                                            echo "<span class='badge'>Available</span>";
                                        }else{
                                            echo "<span class='badge'>Not Available</span>";
                                    }?></td>

                                    <td>
                                        <a href="../doctor.php?id=<?=$doctor['id'] ?>" class="btn-success btn-sm">
                                            <i class="fas fa-eye"></i></a>
                                        <a href="updateDoctor.php?id=<?=$doctor['id'] ?>" class="btn-info btn-sm">
                                            <i class="fas fa-edit"></i></a>
                                        <a href="?delete=<?= $doctor['id'] ?>" onclick="return confirm('Are you sure you want to delete this doctor?')"
                                            class="btn-danger btn-sm">
                                            <i class="fas fa-trash-alt"></i>
                                        </a>
                                    </td>

                            </tr>
                        <?php endforeach; ?>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="d-flex">
            <nav aria-label="Page navigation">
                <ul class="pagination">
                    <?php
                    include '../db/config.php';
                    $total_pages = ceil(getDoctorsCount($conn) / 7);
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

<script>
    function searchSession() {
    let input = document.getElementById("searchInput").value.toLowerCase();
    let rows = document.getElementById("index").getElementsByTagName("tr");

    for (let row of rows) {
        let text = row.textContent.toLowerCase();
        row.style.display = text.includes(input) ? "" : "none";
    }
}
</script>
</body>
<html>