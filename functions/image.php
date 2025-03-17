<?php
function image($image , $target_dir){ 
     $target_file = $target_dir . basename($image["name"]);
     $uploadOk = 1;
     $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
     // Check if image file is a actual image or fake image
     $check = getimagesize($image["tmp_name"]);
     if($check !== false) {
         $uploadOk = 1;
     } else {
         $uploadOk = 0;
     }
     // Check if file already exists
     if (file_exists($target_file)) {
         $uploadOk = 0;
     }
     // Allow certain file formats
     if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
         $uploadOk = 0;
     }
  
    // Check if $uploadOk is set to 0 by an error
     if ($uploadOk != 0) {
         if (move_uploaded_file($image["tmp_name"], $target_file)) {
              return $image["name"];
         } else {
           echo "<script>alert('Sorry, there was an error uploading your file.')</script>";
         }
     }
}