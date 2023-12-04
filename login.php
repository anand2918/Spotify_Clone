<?php

session_start();

 ?>
<html>
<head>
    <title> Transparent Login Form Design </title>
    <link rel="stylesheet" type="text/css" href="llstyle.css">
</head>
    <body>

      <?php

      include "db.php";

       if(isset($_POST["submit"])){

         $email = $_POST["email"];
         $password = $_POST["password"];

         $email_search = "select * from registration where email='$email'";
         $query =mysqli_query($con,$email_search);

         $email_count = mysqli_num_rows($query);

         if($email_count) {
            $email_pass = mysqli_fetch_assoc($query);

            $db_pass = $email_pass['password'];

            $_SESSION['name'] = $email_pass['name'];

            $pass_decode = password_verify($password, $db_pass);

            if($pass_decode){
              ?>
                 <script>
                    alert("Login Successful")
                    location.replace("index.php");
                 </script>
               <?php

            }else{
              ?>
                 <script>
                    alert("Password Incorrect")
                 </script>
               <?php

            }
         }else{
           ?>
              <script>
                 alert("Invalid Email")
              </script>
            <?php

         }

       }

       ?>


    <div class="login-box">
    <img src="images/avatar.png" class="avatar">
        <h1>Login Here</h1>

            <form action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" method="POST">
            <p>Email ID</p>
            <input type="text" name="email" placeholder="Enter your Email ID" required>
            <p>Password</p>
            <input type="password" name="password" placeholder="Enter Password" required>
            <input type="submit" name="submit" value="Login">
            <a href="#">Forget Password?</a><br><br>
            <a href="reg.php">Don't have an account?-Sign Up Here</a>

            </form>


        </div>

    </body>
</html>
