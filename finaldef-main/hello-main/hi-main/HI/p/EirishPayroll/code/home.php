<?php require_once "controllerUserData.php"; 


?>

<?php   
$email = $_SESSION['email'];
$password = $_SESSION['password'];
if($email != false && $password != false){
    $sql = "SELECT * FROM users WHERE email = '$email'";
    $run_Sql = mysqli_query($con, $sql);
    if($run_Sql){
        $fetch_info = mysqli_fetch_assoc($run_Sql);
        $status = $fetch_info['status'];
        $code = $fetch_info['code'];
        if($status == "verified"){
            if($code != 0){
                header('Location: reset-code.php');
            }
        }else{
            header('Location: user-otp.php');
        }
    }
}else{
    header('Location: login-user.php');
}


?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Payroll</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="css/style.css">
  <link rel="shortcut icon" href="./img/favicon-16x16.png" type="image/x-icon">
</head>

<body>

  <center>
<nav class="navbar navbar-expand-lg navbar-blue" style="background-color: rgb(0,0,139)  ">

  <div class="container">
  <img src="./images/eirishh.png" alt="" width="70" height="70">
  <a class="navbar-brand" style="color:  rgb(255,255,255);" href="#">Eirish Builders</a>

    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav ml-auto">
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" style="color:  rgb(255,255,255);" href="#" id="employeeDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="margin-left: 50px; ">
            Employee
          </a>
          <div class="dropdown-menu" aria-labelledby="employeeDropdown">
          <a class="dropdown-item"  href="field_emp.php">Field Employee</a>
          <div class="border-bottom my-3"></div> 
            <a class="dropdown-item" href="employee.php">Master Lists</a>
            <div class="border-bottom my-3"></div> 
            <a class="dropdown-item" href="trash.php">Archive Employee</a>
            <div class="border-bottom my-3"></div> 
            <a class="dropdown-item" href="Cash_adv.php">Cash Advance</a>
          </div>
          
        
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" style="color:  rgb(255,255,255);"href="#" id="attendanceDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Attendance
          </a>
          <div class="dropdown-menu" aria-labelledby="attendanceDropdown">
            <a class="dropdown-item" href="attendance.php">List of Attendance</a>
            <div class="border-bottom my-3"></div> 
            <a class="dropdown-item" href="trash_attendance.php">Archive Attendance</a>
          </div>
        </li>
        <li class="nav-item">
          <a class="nav-link" style="color:  rgb(255,255,255);" href="payrolls.php">Payroll</a>
        </li>
        <li class="nav-item dropdown" style="margin-left: 130px; ">
          <a class="nav-link dropdown-toggle" style="color:  rgb(255,255,255);" href="#" id="accountDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Account Profile
          </a>
         
          <div class="dropdown-menu" aria-labelledby="accountDropdown">

        
            <a href="logout.php" class="dropdown-item">Log Out</a>
          </div>
        </li>
      </ul>
    </div>
  </div>
</nav>
</center>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"></script>
</html>
