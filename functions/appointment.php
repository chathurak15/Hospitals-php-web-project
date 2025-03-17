<?php

autoUpdateSessionStatus($conn);
//add appointment(use prepared statement)
function addAppointment($conn, $sessionID, $phone, $age, $nic, $email, $name, $cardNo, $cvv, $expDate)
{
    $session = getSessionById($sessionID, $conn);
    $appointmentCount = $session['appointmentCount'] + 1;
    $date = $session['date'];
    $timePeriod = $session['timePeriod'];
    $location = $session['location'];
    $doctorId = $session['doctorID'];
    $charges = $session['charges'];
    $doctorname = 'Dr. ' . getDoctorById($doctorId, $conn)['name'];
    $sessionStatus = $session['status'];
    include 'db/config.php';

    if ($sessionStatus == 'Expired' || $sessionStatus == 'Full') {
        return 1;
    }
    $sql = "INSERT INTO appointments (session_id, appointment_No, date, time, mobile_number, age, nic, email, location, name, charges, status, doctor_name, doctorID)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, 'Pending', ?,?)";

    $stmt = mysqli_prepare($conn, $sql);
    $appointmentId;

    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "iisssissssdsi", $sessionID, $appointmentCount, $date, $timePeriod, $phone, $age, $nic, $email, $location, $name, $charges, $doctorname, $doctorId);
        if (mysqli_stmt_execute($stmt)) {
            $appointmentId = mysqli_insert_id($conn);

            // Update session appointment count
            $updateSql = "UPDATE sessions SET appointmentCount = ? WHERE id = ?";
            $updateStmt = mysqli_prepare($conn, $updateSql);

            if ($updateStmt) {
                mysqli_stmt_bind_param($updateStmt, "ii", $appointmentCount, $sessionID);
                if (mysqli_stmt_execute($updateStmt)) {
                    $sql = "INSERT INTO payment_info (appointmentId, cardNo, cvv, expDate) VALUES (?,?,?,?)";
                    $card = mysqli_prepare($conn, $sql);
                    if ($card) {
                        mysqli_stmt_bind_param($card, "isss", $appointmentId, $cardNo, $cvv, $expDate);
                        mysqli_stmt_execute($card);
                        mysqli_stmt_close($card);
                    }
                }
                mysqli_stmt_close($updateStmt);
            }
            mysqli_stmt_close($stmt);
            mysqli_close($conn);
            return 'Appointment added successfully! Your appointmentID: ' . $appointmentId;
        }
        mysqli_stmt_close($stmt);
    }
    mysqli_close($conn);
    return 'Failed to add appointment';
}

//get all appointments in the database
function getAllAppointments($conn)
{
    $sql = "SELECT * FROM appointments ORDER BY id DESC";
    $result = mysqli_query($conn, $sql);
    $appointments = mysqli_fetch_all($result, MYSQLI_ASSOC);
    if (!$appointments) {
        mysqli_close($conn);
        return $appointments;
    }
    mysqli_close($conn);
    return $appointments;
}

function getAppointmentbyCondition($conn, $name, $id, $phone, $nic)
{
    $sql = "SELECT * FROM appointments WHERE name LIKE '%$name%' AND  id='$id' AND mobile_number='$phone' AND nic='$nic'";
    // var_dump($sql);
    $result = mysqli_query($conn, $sql);
    if(mysqli_num_rows($result) == 1){
        $appointment = mysqli_fetch_assoc($result);
        mysqli_close($conn);
        return $appointment;
    }
    mysqli_close($conn);
}
//get all appointments by doctor id in the database.
function getDoctorAppointments($conn, $doctorId, $start, $limit)
{
    $sql = "SELECT * FROM appointments WHERE doctorID='$doctorId' ORDER BY id DESC LIMIT $start, $limit";
    // var_dump($sql);
    $result = mysqli_query($conn, $sql);
    $appointments = mysqli_fetch_all($result, MYSQLI_ASSOC);

    if (!$appointments) {
        return [];
    }

    return $appointments;
}

//get all appointments count by doctor id in the database.
function getDoctorAppointmentsCount($conn, $doctorId)
{
    $sql = "SELECT COUNT(*) FROM appointments WHERE doctorID='$doctorId'";
    $result = mysqli_query($conn, $sql);
    $count = mysqli_fetch_assoc($result);
    return $count['COUNT(*)'];
}

function getAllAppointmentCount($conn)
{
    $sql = "SELECT COUNT(*) FROM appointments";
    $result = mysqli_query($conn, $sql);
    $count = mysqli_fetch_assoc($result);
    return $count['COUNT(*)'];
}

//delete appointment by id in the database
function deleteAppointment($conn, $id)
{
    $sql = "SELECT session_id FROM appointments WHERE id='$id'";
    $result = mysqli_query($conn, $sql);
    $appointment = mysqli_fetch_assoc($result);

    $sql = "DELETE FROM appointments WHERE id='$id'";
    if (mysqli_query($conn, $sql)) {
        $sql = "DELETE FROM payment_info WHERE appointmentId='$id'";
        if (mysqli_query($conn, $sql)) {
            if (!$appointment) {
                return 'Appointment deleted successfully';
            }
            $session = getSessionById($appointment['session_id'], $conn);
            $appointmentCount = $session['appointmentCount'] - 1;
            $sql = "UPDATE sessions SET appointmentCount='$appointmentCount' 
            WHERE id='$appointment[session_id]'";
            if (mysqli_query($conn, $sql)) {
                mysqli_close($conn);
                return 'Appointment deleted successfully';
            }
        }
    }
    return 'Failed to delete appointment';
}

function updateAppointmentStatus($conn, $id, $status)
{
    $sql = "UPDATE appointments SET status='$status' WHERE id='$id'";
    if (mysqli_query($conn, $sql)) {
        mysqli_close($conn);
        return 'Appointment updated successfully';
    }
    mysqli_close($conn);
    return 'Failed to update appointment';
}

//Session functions

//add session to the database
function addSession($conn, $date, $timePeriod, $location, $count, $doctorId, $charges)
{
    $avilable = 0;
    $status = 'Active';
    $formattedDate = date("Y-m-d", strtotime($date));
    $sql = "INSERT INTO sessions (date, timePeriod, location, count, doctorID,appointmentCount,status,charges) 
    VALUES ('$formattedDate', '$timePeriod', '$location', '$count', '$doctorId','$avilable','$status' , '$charges')";
    if (mysqli_query($conn, $sql)) {
        return 'Session added successfully';
    }
    return 'Failed to add session';
}
//get all sessions in the database. join with doctors table to get doctor name for each session
function getSessions($conn)
{
    $sql = "SELECT s.id,s.date,s.timePeriod,s.location,s.count,s.appointmentCount,s.status,s.charges,d.name FROM sessions s 
    JOIN doctors d ON s.doctorId=d.id
    GROUP BY s.id";
    $result = mysqli_query($conn, $sql);
    $sessions = mysqli_fetch_all($result, MYSQLI_ASSOC);

    if (!$sessions) {
        return ['error' => 'No sessions found'];
    }
    return $sessions;
}

//get a session by id in the database. join with doctors table to get doctor name for the session
function getSessionById($id, $conn)
{
    $sql = "SELECT sessions.*, d.name FROM sessions 
    JOIN doctors d ON sessions.doctorID = d.id
    WHERE sessions.id='$id'";
    $result = mysqli_query($conn, $sql);
    $session = mysqli_fetch_assoc($result);

    if (!$session) {
        return $session;
    }
    return $session;
    mysqli_close($conn);
}
//get all session by doctor id in the database. check if the session is not expired and date.
function getSessionsByDoctorId($conn, $doctorId, $date)
{
    $sql = "SELECT * FROM sessions WHERE doctorID='$doctorId' AND date='$date' AND status !='Expired'";
    $result = mysqli_query($conn, $sql);
    $sessions = mysqli_fetch_all($result, MYSQLI_ASSOC);

    if (!$sessions) {
        return ['error' => 'No sessions found'];
    }
    return $sessions;
}

//get all sessions by doctor id in the database. without checking the date and status.
function getDoctorSessions($conn, $doctorId)
{
    $sql = "SELECT * FROM sessions WHERE doctorID='$doctorId' ORDER BY date ASC";
    $result = mysqli_query($conn, $sql);
    $sessions = mysqli_fetch_all($result, MYSQLI_ASSOC);

    if (!$sessions) {
        return [];
    }
    return $sessions;
}

//search sessions by conditions in the database.(pass the data from appointment.php)
function searchSessions($conn, $conditions)
{
    $sql = "SELECT * FROM sessions WHERE status != 'Expired' AND " . implode(" AND ", $conditions) . " GROUP BY doctorID, date ORDER BY date ASC";
    $result = mysqli_query($conn, $sql);
    $sessions = mysqli_fetch_all($result, MYSQLI_ASSOC);

    if (!$sessions) {
        return [];
    }
    return $sessions;
}

//update session by id in the database(pass the data from updateSessions.php)
function updateSession($conn, $id, $date, $timePeriod, $location, $count, $appointmentCount, $doctorId, $status, $charges)
{
    $formattedDate = date("Y-m-d", strtotime($date));
    $sql = "UPDATE sessions SET date='$formattedDate', timePeriod='$timePeriod', location='$location', count='$count', appointmentCount='$appointmentCount',	 doctorID='$doctorId', status='$status', charges='$charges'
    WHERE id='$id'";
    if (mysqli_query($conn, $sql)) {
        return 'Session updated successfully';
    }
    return 'Failed to update session';
}

//get all session and check date one by one and find session date<current Date. update session status by id in the database automatically.
function autoUpdateSessionStatus($conn)
{
    $sql = "SELECT id,date,count,appointmentCount FROM sessions";
    $result = mysqli_query($conn, $sql);
    $sessions = mysqli_fetch_all($result, MYSQLI_ASSOC);
    date_default_timezone_set('Asia/Colombo');
    $currentDate = date('Y-m-d');

    foreach ($sessions as $session) {
        if ($session['date'] < $currentDate) {

            $sql = "UPDATE sessions SET status='Expired' WHERE id='$session[id]'";
            mysqli_query($conn, $sql);
        } elseif ($session['count'] <= $session['appointmentCount']) {
            $sql = "UPDATE sessions SET status='Full' WHERE id='$session[id]'";
            mysqli_query($conn, $sql);
        }
    }
    return 0;
    mysqli_close($conn);
}

//delete session by id in the database
function deleteSession($conn, $id)
{
    $sql = "DELETE FROM sessions WHERE id='$id'";
    if (mysqli_query($conn, $sql)) {
        return 'Session deleted successfully';
    }
    return 'Failed to delete session';
}

function getAllAvailableSessionCount($conn)
{
    $sql = "SELECT COUNT(*) FROM sessions WHERE status != 'Expired' AND status != 'Full'";
    $result = mysqli_query($conn, $sql);
    $count = mysqli_fetch_assoc($result);
    return $count['COUNT(*)'];
}