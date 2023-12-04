<?php

session_start() ;

 ?>
<html>
<head>
    <title> Transparent Login Form Design </title>
    <link rel="stylesheet" type="text/css" href="rrstyle.css">
</head>
    <body>

      <?php

      include "db.php";

       if(isset($_POST["submit"])){
         $name = mysqli_real_escape_string($con, $_POST["name"]) ;
         $email = mysqli_real_escape_string($con, $_POST["email"]) ;
         $mobile = mysqli_real_escape_string($con, $_POST["mobile"]) ;
         $password = mysqli_real_escape_string($con, $_POST["password"]) ;
         $cpassword = mysqli_real_escape_string($con, $_POST["rpassword"]) ;

         $pass = password_hash($password, PASSWORD_BCRYPT);
         $cpass = password_hash($cpassword, PASSWORD_BCRYPT);

         $emailquery = "select * from registration where email='$email'";
         $query =mysqli_query($con,$emailquery);

         $emailcount = mysqli_num_rows($query);

         if($emailcount>0){
           ?>
              <script>
                 alert("Email already exists")
              </script>
            <?php
         }else{
           if($password == $cpassword ){

             $insertquery = "insert into registration( name, email, mobile, password, rpassword ) values('$name','$email','$mobile','$pass','$cpass')";

             $iquery = mysqli_query($con, $insertquery);

             if ($iquery) {
                ?>
                   <script>
                      alert("Registration Successful")
                      location.replace("login.php"); 
                   </script>

                 <?php
             }else{
                ?>
                   <script>
                      alert("Not inserted")
                   </script>
                 <?php
             }

           }else{
             ?>
                <script>
                   alert("Password are not matching")
                </script>
              <?php
           }
         }


       }
       ?>
    <div class="login-box">
    <img src="images/avatar.png" class="avatar">
        <h1>Register Here</h1>
            <form action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" method="POST">
            <p>Full Name</p>
            <input type="text" name="name" placeholder="Enter your Full Name" required>
            <p>Email</p>
            <input type="text" name="email" placeholder="Enter your email address" required>
            <p>Mobile Number</p>
            <input type="text" name="mobile" placeholder="Enter your Mobile Number" required>
            <p>Password</p>
            <input type="password" name="password" placeholder="Enter Password" required>
            <p>Renter Password</p>
            <input type="password" name="rpassword" placeholder="Renter Password" required>
            <input type="submit" name="submit" value="Create Account">
            Have an account?<a href="login.php"> Log In</a>

            </form>


        </div>

    </body>
</html>
