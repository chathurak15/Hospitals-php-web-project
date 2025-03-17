<?php
include 'header.php';

if (!isset($_GET['id'])) {
    header('Location: /admin/sessions.php');
}
include '../db/config.php';
include '../functions/appointment.php';
include '../functions/doctors.php';
$session = getSessionById($_GET['id'], $conn);
$currentDoctor = getDoctorById($session['doctorID'], $conn);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    include '../db/config.php';
    $doctor_id = filter_var($_POST['doctor_id'], FILTER_SANITIZE_NUMBER_INT);
    $date = filter_var($_POST['date'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $time_period = htmlspecialchars($_POST['time_period'], ENT_QUOTES, 'UTF-8');
    $location = htmlspecialchars($_POST['location'], ENT_QUOTES, 'UTF-8');
    $count = filter_var($_POST['max_seats'], FILTER_SANITIZE_NUMBER_INT);
    $appointmentCount = filter_var($_POST['appointmentCount'], FILTER_SANITIZE_NUMBER_INT);
    $status = filter_var($_POST['status'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $id = filter_var($_POST['id'], FILTER_SANITIZE_NUMBER_INT);
    $charges = $_POST['charges'];
    $response = updateSession($conn, $id, $date, $time_period, $location, $count, $appointmentCount, $doctor_id, $status, $charges);
    echo "<script>alert('$response'); window.location.href='sessions.php';</script>";
    exit();
}
?>

<div class="dashboard-content">
    <div class="card-body">
        <h5 class="addnewtitle">Update Sessions</h5>
        <form id="sessionForm" action="" method="POST">
            <?php
            include '../db/config.php';
            $doctors = getDoctors($conn);
            ?>
            <select class="add-group" id="doctor_id" name="doctor_id">
                <option selected value="<?= $currentDoctor['id'] ?>"><?= $currentDoctor['regNo'] . ' - Dr.' . $currentDoctor['name'] . ' ( ' . $currentDoctor['certificates'] . ' ) ' ?></option>
                <?php foreach ($doctors as $doctor): ?>
                    <option value="<?= $doctor['id'] ?>"><?= $doctor['regNo'] . ' - Dr.' . $doctor['name'] . '(' . $doctor['certificates'] . ')' ?></option>
                <?php endforeach; ?>
            </select>
            <input type="date" class="add-group" id="date" name="date" value="<?= $session['date'] ?>">
            <select id="time_period" class="add-group" name="time_period">
                <option value="<?= $session['timePeriod'] ?>"><?= $session['timePeriod'] ?></option>
                <option value="6:00 AM - 8:00 AM">6:00 AM - 8:00 AM</option>
                <option value="4:00 PM - 6:00 PM">4:00 PM - 6:00 PM</option>
                <option value="5:00 PM - 7:00 PM">6:00 PM - 7:00 PM</option>
                <option value="7:00 PM - 8:00 PM">7:00 PM - 8:00 PM</option>
                <option value="8:00 PM - 9:00 PM">8:00 PM - 9:00 PM</option>
            </select>
            <select id="location" class="add-group" name="location">
                <option value="<?= $session['location'] ?>"><?= $session['location'] ?></option>
                <option value="Colombo">Colombo</option>
                <option value="Kandy">Kandy</option>
                <option value="Kurunagala">Kurunagala</option>
            </select>
            <input type="number" class="add-group" id="max_seats" name="max_seats" placeholder="Max Seats" value="<?= $session['count'] ?>">
            <input type="number" class="add-group" id="complete" name="appointmentCount" value="<?= $session['appointmentCount'] ?>">
            <select id="status" class="add-group" name="status">
                <option value="<?= $session['status'] ?>"><?= $session['status'] ?></option>
                <option value="Active">Active</option>
                <option value="Expired">Expired</option>
                <option value="Full">Full</option>
            </select>
            <input type="number" class="add-group" id="charges" name="charges" placeholder="Charges" value="<?= $session['charges'] ?>">
            <input type="hidden" name="id" value="<?= $session['id'] ?>">
            <button type="submit" class="btn success">Update Session</button>
        </form>
    </div>
</div>
</body>

</html>