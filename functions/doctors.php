<?php

//add doctor to the database.
function addDoctor($conn, $regNo, $name,$number, $specialist,$image,$description,$experience, $certificates,$language,$userId, $availability,){
    if($userId==''){
        $userId = 0;
    }
    $sql = "INSERT INTO doctors (regNo, name, number, specialist, image, description, experience, certificates, language, userId, availability) 
    VALUES ('$regNo', '$name', '$number', '$specialist', '$image', '$description', '$experience', '$certificates', '$language', '$userId', '$availability')";
    // var_dump($sql);
    $result = mysqli_query($conn, $sql);
    
    if($result){
        mysqli_close($conn);
        return 'Doctor added successfully';
    }else{
        mysqli_close($conn);
        return 'Failed to add doctor';
    }
}
//get all available doctors in the database(get doctor regNo, id, name, certificates)
function getAvailableDoctors($conn){
    $sql = "SELECT regNo,id,name, certificates FROM doctors where availability=1";
    $result = mysqli_query($conn, $sql);
    $doctors = mysqli_fetch_all($result, MYSQLI_ASSOC);

    if(!$doctors){
        mysqli_close($conn);
        return ['error'=>'No doctors found'];
    }
    mysqli_close($conn);
    return $doctors;
}

//get all doctors in the database(get doctor regNo, id, name, certificates)
function getDoctors($conn){
    $sql = "SELECT regNo,id,name, certificates FROM doctors";
    $result = mysqli_query($conn, $sql);
    $doctors = mysqli_fetch_all($result, MYSQLI_ASSOC);

    if(!$doctors){
        mysqli_close($conn);
        return ['error'=>'No doctors found'];
    }
    mysqli_close($conn);
    return $doctors;
}

//get all doctors in the database using conditions and pagination(use for searching)
function getDoctorsConditions($conn, $conditions, $start, $limit){
    $sql = "SELECT d.*, s.id AS sId, s.name AS specialistName FROM doctors d 
    LEFT JOIN doctors_speciality s ON d.specialist = s.id WHERE " . implode(" AND ", $conditions)." LIMIT $start, $limit";
    // var_dump($sql);
    $result = mysqli_query($conn, $sql);
    $doctors = mysqli_fetch_all($result, MYSQLI_ASSOC);

    if(!$doctors){
        mysqli_close($conn);
        return $doctors;
    }
    mysqli_close($conn);
    return $doctors;
}

//get a doctor with specialistName by id in the database.
function getDoctorById($id, $conn){
    $sql = "SELECT doctors.* ,s.id AS sId, s.name AS specialistName FROM doctors
    LEFT JOIN doctors_speciality s ON doctors.specialist=s.id WHERE doctors.id='$id'";
    $result = mysqli_query($conn, $sql);
    $doctor = mysqli_fetch_assoc($result);
    // var_dump($doctor);
    if(!$doctor){
        mysqli_close($conn);
        return ['error'=>'No doctor found'];
        
    }
    mysqli_close($conn);
    return $doctor;
    
}

//get all doctors with pagination in the database.
function getDoctorsWithPagination($conn, $start, $limit){
    $sql = "SELECT d.*, s.name AS specialistName  FROM doctors d 
    LEFT JOIN doctors_speciality s ON d.specialist=s.id
    ORDER BY id ASC LIMIT $start, $limit";
    // var_dump($sql);
    $result = mysqli_query($conn, $sql);
    $doctors = mysqli_fetch_all($result, MYSQLI_ASSOC);
    
    if(!$doctors){
        mysqli_close($conn);
        return $doctors;
    }
    mysqli_close($conn);
    return $doctors;     
}

//get all doctors count in the database.
function getDoctorsCount($conn){
    $sql = "SELECT COUNT(*) FROM doctors";
    $result = mysqli_query($conn, $sql);
    $count = mysqli_fetch_row($result);
    
    if(!$count){
        mysqli_close($conn);
        return ['error'=>'No doctors found'];
    }
    return $count[0];
    mysqli_close($conn);
}

//get a doctor by userId in the database.
function getDoctorByUserId($conn, $userId){
    $sql = "SELECT * FROM doctors WHERE userId='$userId'";
    $result = mysqli_query($conn, $sql);
    $doctor = mysqli_fetch_assoc($result);

    if($doctor==null || mysqli_num_rows($result)!=1){
        return [];
    }
    mysqli_close($conn);
    return $doctor;

}

//delete doctor by id in the database.
function deleteDoctor($conn, $id){
    $sql = "DELETE FROM doctors WHERE id='$id'";
    $result = mysqli_query($conn, $sql);
    
    if($result){
        mysqli_close($conn);
        return 'Doctor deleted successfully';
    }else{
        mysqli_close($conn);
        return 'Failed to delete doctor';
    }
}

//update doctor by id in the database.
function updateDoctor($conn, $id, $regNo, $name,$number, $specialist,$image,$description,$experience, $certificates,$language,$userId, $availability){
    $sql = "UPDATE doctors SET regNo='$regNo', name='$name', number='$number', specialist='$specialist', image='$image', description='$description', experience='$experience', certificates='$certificates', language='$language', userId='$userId', availability='$availability' WHERE id='$id'";
    $result = mysqli_query($conn, $sql);
    
    if($result){
        mysqli_close($conn);
        return 'Doctor updated successfully';
    }else{
        mysqli_close($conn);
        return 'Failed to update doctor';
    }
}

//add speciality to the database.
function addSpeciality($conn, $name){
    $sql = "INSERT INTO doctors_speciality (name) VALUES ('$name')";
    // var_dump($sql);
    $result = mysqli_query($conn, $sql);
    
    if($result){
        mysqli_close($conn);
        return 'Speciality added successfully';
    }else{
        mysqli_close($conn);
        return 'Failed to add speciality';
    }
}

//get all specialities in the database.
function getAllSpecialities($conn){
    $sql = "SELECT * FROM doctors_speciality";
    $result = mysqli_query($conn, $sql);
    $specialities = mysqli_fetch_all($result, MYSQLI_ASSOC);
    
    if(!$specialities){
        mysqli_close($conn);
        return ['error'=>'No specialities found'];
    }
    mysqli_close($conn);
    return $specialities;
}

//get specialities by id in the database.
function getSpecialitiesById($id, $conn){
    $sql = "SELECT name FROM doctors_speciality WHERE id='$id'";
    $result = mysqli_query($conn, $sql);
    $speciality = mysqli_fetch_row($result);
    
    if(!$speciality){
        mysqli_close($conn);
        return 'No speciality found';
    }
    mysqli_close($conn);
    return $speciality[0];
}