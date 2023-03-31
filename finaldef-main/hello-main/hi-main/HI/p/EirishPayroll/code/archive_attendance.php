<?php
include('connection.php');

if(isset($_POST['checkbox'])){
	foreach($_POST['checkbox'] as $list){
		$id=mysqli_real_escape_string($con,$list);

		$employee = "UPDATE `attendancee` SET `isattendance`='1' WHERE `id` = '$id';";
     

		if(mysqli_query($con, $employee)){
			$result = mysqli_query($con, $employee);
		} else{
			echo "Error: ".mysqli_error($con);  
		} 
	} 
	echo "<script>" . "window.location.href='attendance.php';" . "</script>"; 
}
?>
