<?php require_once "controllerUserData.php"; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Payroll</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">

</head>
<body>
<div style="display: flex;  margin-top: 3%; margin-left: 15%;">
  <img name="img" src="./images/kkk.jpg" alt="" width="480" height="600" style="border-radius: 10px; box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);">
</div>

    <div class="container">
        <div class="row justify-content-end">
            <div class="col-md-4 offset-md-4 form login-form">
                <form action="login-user.php" method="POST" autocomplete="">
                    <h2 class="text-center">Login</h2>
                    <p class="text-center">Please enter your email and password to continue.</p>
                    <?php
                    if(count($errors) > 0){
                        ?>
                        <div class="alert alert-danger text-center">
                            <?php
                            foreach($errors as $showerror){
                                echo $showerror;
                            }
                            ?>
                        </div>
                        <?php
                    }
                    ?>
                    <div class="form-group">
                        <label>Email Address</label>
                        <input class="form-control" type="email" name="email" placeholder="Enter your Email Address" required value="<?php echo $email ?>">
                    </div>
                    <div class="form-group">
                    <label>Password</label>
                        <input class="form-control" type="password" name="password" id="password" placeholder="Enter your Password" required>
                        <input class="mb-4 mt-3" type="checkbox" onclick="myFunction()"> Show Password
                    </div>
                    <div class="link forget-pass text-left"><a href="forgot-password.php">Forgot password?</a></div>
                    <div class="form-group">
                        <input class="form-control button" type="submit" name="login" value="Login">
                    </div>
                    
                    <div class="link login-link text-center">Don't have an account ? <a href="signup-user.php">Signup now</a></div>
                </form>
            </div>
        </div>
    </div>
    <script>
        function myFunction() {
            var x = document.getElementById("password");
            if (x.type === "password") {
                x.type = "text";
            } else {
                x.type = "password";
            }
            }
    </script>
</body>
</html>