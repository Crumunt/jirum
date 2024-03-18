<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Login form</title>

   <link rel="stylesheet" href="bootstrap/css/bootstrap.css">
   <script src="bootstrap/js/bootstrap.js"></script>
</head>

<style>
   body {
      height: 100vh;
   }
</style>

<body class="container mt-5">

   <div class="w-100 d-flex align-items-center justify-content-center h-100 flex-column mx-auto">
      <h1>Login</h1>
      <form action="form_handlers/login-signupHandler.php" method="POST" class="w-50 mt-3 border rounded-1 p-5 shadow">

         <div class="form-group">
            <label class="text-uppercase mb-1 form-label">Email</label>
            <input class="form-control w-100 p-2" type="email" name="email" required placeholder="Enter your email">
         </div>

         <div class="form-group mt-3">
            <label class="text-uppercase mb-1 form-label">Password</label>
            <input class="form-control w-100 p-2" type="password" name="password" required placeholder="Enter your password">
         </div>

         <div class="form-group mt-3">
            <input type="submit" name="login" value="Login" class="btn btn-primary w-100">
         </div>

         <div class="form-group mt-3">
            <p class="text-center">Don't have an account? <a href="signup.php">Register now</a></p>
            <div>

      </form>
   </div>

</body>

</html>