<?php   
   
  require_once "connection.php"; 

  $id = $_GET['id'];

  $remove = "UPDATE `employee` SET `isdeploy`='0' WHERE `id` = '$id';";
 
  if(mysqli_query($con, $remove)){
    $query = "DELETE FROM `archive_attendancee` WHERE id = '$id'";  
    if(mysqli_query($con, $remove)) {  
        echo "<script>" . "window.location.href='field_emp.php';" . "</script>";  
   }else{  
        echo "Error: ".mysqli_error($con);  
   }  
  }


