<?php
include "../classes/dbh.php";
include "../classes/model/adminModel.php";
include "../classes/view/adminView.php";

$id = $_GET['id'] ?? NULL;

if ($id == NULL) {
    header("location: admincrud.php");
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Edit Record</title>
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.css">
    <script src="../bootstrap/js/bootstrap.js"></script>
</head>

<body class="container mt-5">
    <div class="container">
        <div class="row border-bottom mb-4 d-flex align-items-center">
            <div class="col-11">
                <h2>Edit Record</h2>
            </div>
            <div class="col-1">
            </div>
        </div>

        <?php



        $adminView = new AdminView();

        $studentRecord = $adminView->fetchStudent($id);
        ?>

        <form action="../form_handlers/adminHandler.php" method="post">

            <div class="hidden">
                <input type="hidden" name="id" value="?id=<?=$id?>">
            </div>
          
            <div class="form-group">
                <h3>Full name</h3>
                <input class="form-control" type="text" id="name" name="name" value="<?= $studentRecord[0]['name']; ?>"><br>
            </div>

            <div class="form-group">
                <h3>Age</h3>
                <input class="form-control" type="text" id="age" name="age" value="<?= $studentRecord[0]['age']; ?>"><br>
            </div>

            <div class="form-group">
                <h3>Email</h3>
                <input class="form-control" type="text" id="email" name="email" value="<?= $studentRecord[0]['email']; ?>"><br>
            </div>

            <div class="form-group">
                <h3>GPA</h3>
                <input class="form-control" type="text" id="gpa" name="gpa" value="<?= number_format($studentRecord[0]['gpa'], 2); ?>"><br>
            </div>

            <div class="wrapper w-100 d-flex flex-column justify-content-center gap-2">
                <input type="submit" value="Update" class="btn btn-warning w-25 p-3 mx-auto">
                <a href="admincrud.php" class="btn btn-primary w-25 p-3 mx-auto">Back</a>

            </div>
        </form>
    </div>

</body>

</html>