<?php
include "connection.php";

$userid = $_POST['userid'];
 
$sql = "select * from employee where id=".$userid;
$result = mysqli_query($con,$sql);
while( $row = mysqli_fetch_array($result) ){
?>
<table border='0' width='100%'>
<tr style="margin-left: 10px">

    <p>Name : <?php echo $row['name']; ?></p>
    <p>Address : <?php echo $row['address']; ?></p>
    <p>Position : <?php echo $row['position']; ?></p>
    <p>Rate: <?php echo $row['rate']; ?></p>
    <p>Contact Number : <?php echo $row['phonenumber']; ?></p>
    <p>Sex : <?php echo $row['sex']; ?></p>
    <p>Civil Status : <?php echo $row['civil_status']; ?></p>
    <p>Person to be contacted in case of emergency : <?php echo $row['emergency_name']; ?></p>
    <p>His/Her contact details : <?php echo $row['emergency_contact']; ?></p>
    </td>
</tr>
</table>
 
<?php } ?>


