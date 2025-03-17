<?php
include 'header.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    include '../db/config.php';
    include '../functions/doctors.php';
    $name = $_POST['name'];
    $response = addSpeciality($conn, $name);
    echo "<script>alert('$response'); window.location.href='specialties.php';</script>";
    exit();
}
// if(isset($_GET['id'])){
//     $id = $_GET['id'];
//     echo "<style>.update{display: block !important;}</style>";
//     echo "<style>.add{display: none !important;}</style>";
// }
?>


<!-- Search Bar -->
<div class="dashboard-content">
    <div  class="card-body">
        <div class="search-bar">
            <input type="text" id="searchInput" placeholder="Search by Doctor, Date, or Location" onkeyup="searchSession()">
            <button class="btn-primary" onclick="openModal()">Add New Specialties</button>
        </div>

        <!-- Popup Form -->
        <div id="sessionModal" class="modal">
            <div class="modal-content">
                <span class="close-btn" onclick="closeModal()">&times;</span>
                <h2 class="addnewtitle">Add New Specialties</h2>
                <form id="sessionForm" action="" method="POST">

                    <input type="text" class="add-group" id="name" name="name" placeholder="Eg: Cardiologist" required>
                    <button type="submit" class="btn success">Add </button>
                </form>
            </div>
        </div>

    <!-- Sessions Table -->
    <table border="1">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody id="sessionTable">
            <?php
            include '../db/config.php';
            include '../functions/doctors.php';
            $specialties = getAllSpecialities($conn);
            if ($specialties == null) {
                echo "<tr><td colspan='10'>No Sessions Found</td></tr>";
            }
            foreach ($specialties as $specialty):
            ?>
                <tr>
                    <td><?= $specialty['id'] ?></td>
                    <td><?= $specialty['name'] ?></td>
                    <td>
                        <a href="?id=<?= $specialty['id'] ?>"><button class="edit-btn"> <i class="fas fa-edit"></i>Edit</button></a>
                    </td>
                </tr>
            <?php endforeach; ?>

        </tbody>
    </table>

    <!-- <div id="update" class="update" style="display: none;">
            <span class="close-btn" onclick="closeModal()">&times;</span>
            <h2 class="addnewtitle">Update</h2>
            <form id="sessionForm" action="" method="POST">

                <input type="text" class="add-group" id="name" name="name" placeholder="Eg: Cardiologist" required>
                <button type="submit" name="update" value="Update" class="btn success">Update</button>
            </form>
            </div> -->

        </div>
    </div>

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
</script>

</body>

</html>