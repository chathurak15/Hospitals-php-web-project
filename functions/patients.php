<?php

//add new inquiry to the database, get user inputs ,sanitize, validate and insert into the database
function addInquiry($conn, $name, $email, $phone, $message)
{
    $conn = $GLOBALS['conn'];
    if($name == '' || $phone == '' || $message == ''){
        return 'required fields cannot be empty';
    }
    //sanitize user inputs
    $newName = filter_var($name, FILTER_SANITIZE_SPECIAL_CHARS);
    $newEmail = filter_var($email, FILTER_SANITIZE_EMAIL);
    $newPhone = filter_var($phone, FILTER_SANITIZE_NUMBER_INT);
    $newMessage = htmlspecialchars($message, ENT_QUOTES, 'UTF-8');

    $status = 'pending';
    date_default_timezone_set('Asia/Colombo');
    $date = date('Y-m-d') ;

    $sql = "INSERT INTO inquiries (name, email, number, message, status, date) 
    VALUES ('$newName', '$newEmail', '$newPhone', '$newMessage', '$status', '$date')";
    $result = mysqli_query($conn, $sql);

    //check if the inquiry is successfully insert and return message
    if ($result) {
        return 'Inquiry sent successfully. We will contact you soon. Thank you!!';
    } else {
        return 'Failed to send inquiry. Please try again later';
    }
    mysqli_close($conn);
}

function addFeedback($conn, $name, $email,$image, $message,$location)
{
    if($name == '' || $message == '' || $location == ''){
        return 'required fields cannot be empty';
    }

    $newName = filter_var($name, FILTER_SANITIZE_SPECIAL_CHARS);
    $newEmail = filter_var($email, FILTER_SANITIZE_EMAIL);
    $newMessage = htmlspecialchars($message, ENT_QUOTES, 'UTF-8');

    $status = 'pending';
    date_default_timezone_set('Asia/Colombo');
    $date = date('Y-m-d') ;

    $sql = "INSERT INTO feedbacks (name, email, image, message, status, date,location) VALUES ('$newName', '$newEmail', '$image', '$newMessage', '$status', '$date' ,'$location')";
    $result = mysqli_query($conn, $sql);

    //check if the inquiry is successfully insert and return message
    if ($result) {
        return 'Feedback sent successfully. Thank you!!';
    } else {
        return 'Failed to send feedback. Please try again later';
    }
    mysqli_close($conn);
}

function getAllInquiries($conn, $start, $limit){
    $sql = "SELECT * FROM inquiries ORDER BY id DESC LIMIT $start, $limit";
    $result = mysqli_query($conn, $sql);
    $inquiries = mysqli_fetch_all($result, MYSQLI_ASSOC);

    if(!$inquiries){
        return ['error'=>'No inquiries found'];
        
    }
    return $inquiries;
    mysqli_close($conn);

}

function getInquiriesCount($conn){
    $sql = "SELECT COUNT(*) FROM inquiries";
    $result = mysqli_query($conn, $sql);
    $count = mysqli_fetch_row($result);
    return $count[0];
    mysqli_close($conn);
}
function getAllFeedbacks($conn, $start, $limit){
    $sql = "SELECT * FROM feedbacks ORDER BY id DESC LIMIT $start, $limit ";
    $result = mysqli_query($conn, $sql);
    $feedbacks = mysqli_fetch_all($result, MYSQLI_ASSOC);

    mysqli_close($conn);
    return $feedbacks;
}
function getAllApprovedFeedbacks($conn, $start, $limit){
    $sql = "SELECT * FROM feedbacks WHERE status='Approved' ORDER BY id DESC LIMIT $start, $limit ";
    $result = mysqli_query($conn, $sql);
    $feedbacks = mysqli_fetch_all($result, MYSQLI_ASSOC);

    mysqli_close($conn);
    return $feedbacks;
}
  
function getFeedbacksCount($conn){
    $sql = "SELECT COUNT(*) FROM feedbacks";
    $result = mysqli_query($conn, $sql);
    $count = mysqli_fetch_row($result);
    return $count[0];
    mysqli_close($conn);
}
function updateFeedbackStatus($conn, $id, $status){
    $sql = "UPDATE feedbacks SET status='$status' WHERE id='$id'";
    $result = mysqli_query($conn, $sql);

    if($result){
        return 'Status updated successfully';
    }else{
        return 'Failed to update status';
    }
    mysqli_close($conn);
}
function updateInquiryStatus($conn, $id, $status){
    $sql = "UPDATE inquiries SET status='$status' WHERE id='$id'";
    // var_dump($sql);
    $result = mysqli_query($conn, $sql);

    if($result){
        return 'Status updated successfully';
    }else{
        return 'Failed to update status';
    }
    mysqli_close($conn);
}

function deleteFeedback($conn, $id){
    $sql = "DELETE FROM feedbacks WHERE id='$id'";
    $result = mysqli_query($conn, $sql);

    if($result){
        return 'FeedBack deleted successfully';
    }else{
        return 'Failed to delete feedback';
    }
    mysqli_close($conn);
}