<?php
@include 'config.php';
session_start();

if(isset($_SESSION['student_name']) || isset($_SESSION['admin_name'])) {

   if($row['user_type'] == 'admin'){
      header('location: admincrud.php');
   } else {
      header('location: viewstudent.php');
   }

   exit();

}

if(isset($_POST['submit'])){

   $email = mysqli_real_escape_string($conn, $_POST['email']);
   $password = $_POST['password'];
   
   $hashed_password = password_hash($password, PASSWORD_DEFAULT);

   $select = "SELECT * FROM student INNER JOIN login ON student.id = login.student_id AND student.email = '$email'";
   $result = mysqli_query($conn, $select);

   if(mysqli_num_rows($result) > 0){

      $row = mysqli_fetch_assoc($result);

      if (password_verify($password, $row['password'])) {
         $_SESSION['loggedin'] = true;
         $_SESSION['user_id'] = $row['student_id'];

         if($row['user_type'] == 'admin'){
            $_SESSION['admin_name'] = $row['name'];
            header('location: admincrud.php');
         } else {
            $_SESSION["student_name"] = $row['name'];
            header('location: viewstudent.php');
         
         }
      } else {
         echo "<script>
         window.onload = function() {
         var errorPopup = document.createElement('div');
         errorPopup.innerHTML = '<span class=\"error-msg\">Incorrect email or password! Please check your credentials and try again.</span>';
         errorPopup.className = 'popup';
         document.body.appendChild(errorPopup);
         setTimeout(function() {
            errorPopup.style.display = 'none';
         }, 1000); // Hides the popup after 1 second (1000 milliseconds)
      };
         </script>";

      }

   } 
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Login form</title>
  
   <link rel="stylesheet" href="style.css">
</head>
<body>  

<div class="container">
   <div class="box form-box">
      <h1>Login</h1>
      <form action="" method="POST">
      
      <div class = "field input">
      <h3>Email</h3>
      <input type="email" name="email" required placeholder="Enter your email">
      </div>

      <div class = "field input">
      <h3>Password</h3>
      <input type="password" name="password" required placeholder="Enter your password">
      </div>

      <div class = "field input">
      <input type="submit" name="submit" value="Login" class="btn">
      </div>

      <div class = "field input">
      <p>Don't have an account? <a href="studentform.php">Register now</a></p>
      <div>

   </form>
   </div>
</div>
</body>
</html>
