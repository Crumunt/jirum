<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <link rel="stylesheet" href="style.css"> -->

    <link rel="stylesheet" href="bootstrap/css/bootstrap.css">
    <script src="bootstrap/js/bootstrap.js"></script>

    <title>Student Form</title>
</head>

<style>
    body {
        height: 100vh;
    }
</style>

<body class="container mt-5 bg-light-subtle">
    <div class="d-flex justify-content-center align-items-center flex-column h-100 w-100 mx-auto">

        <h1 class="mb-3">Sign Up</h1>

        <form action="form_handlers/login-signupHandler.php" method="POST" class="border p-5 shadow rounded-3 w-50 bg-white">

            <div class="form-group">
                <label class="form-label">Full Name</label>
                <input class="form-control p-2" type="text" id="name" name="name" placeholder="Full Name" title="Please enter only letters in the Full Name field." required><br>
            </div>

            <div class="form-group mb-3">
                <label class="form-label">Age</label>
                <input class="form-control p-2" type="text" pattern="[0-9]{2}" title="Enter a 2 digit age" id="age" name="age" placeholder="Enter your age">
            </div>

            <div class="form-group mb-3">
                <label class="form-label">Email</label>
                <input class="form-control p-2" type="email" id="email" name="email" placeholder="Enter your email" required>
            </div>

            <div class="form-group mb-3">
                <label class="form-label">Password</label>
                <input class="form-control p-2" type="text" name="password" id="password" placeholder="Enter your password" required>
            </div>

            <div class="form-group">
                <input type="hidden" name="action" id="action" value="insert">
                <input type="submit" value="Submit" name="signup" class="btn btn-primary w-100 text-center text-uppercase">
            </div>

            <div class="links">
                <p class="text-center mt-4"><a href="index.php">Already have an account? </a></p>
            </div>

        </form>
    </div>


</body>

</html>