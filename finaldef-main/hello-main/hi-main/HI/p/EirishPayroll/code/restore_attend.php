<?php   
   
  require_once "connection.php"; 

  $id = $_GET['id'];

  $employee = "UPDATE `attendancee` SET `isattendance`='0' WHERE `id` = '$id';"; 

  if(mysqli_query($con, $employee)){
    $result = mysqli_query($con, $employee);
  } else{
    echo "Error: ".mysqli_error($con);  
  } 

echo "<script>" . "window.location.href='trash_attendance.php';" . "</script>"; 

?>