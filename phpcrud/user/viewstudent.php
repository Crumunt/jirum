<?php
include "../classes/dbh.php";
include "../classes/model/studentModel.php";
include "../classes/view/studentView.php";
session_start();

$studentID = $_SESSION['userID'] ?? NULL;

if ($studentID == NULL) {
    header("location: ../index.php");
    exit();
}

$studentView = new StudentView();

$credentials = $studentView->fetchCredentials($studentID);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <link rel="stylesheet" href="style.css"> -->

    <link rel="stylesheet" href="../bootstrap/css/bootstrap.css">

    </style>
    <title>View Records</title>
</head>

<body class="bg-light-subtle">


    <div class="container mt-5">
        <div class="row container-fluid mb-3 border-bottom pb-3">
            <div class="col-11">
                <h2 class="">Welcome <span class="fw-bold"><?= $credentials[1] ?></span>!</h2>
            </div>

            <div class="col-1">
                <a href="../form_handlers/logout.php" class="btn btn-primary p-2">Logout</a>
            </div>
        </div>

        <table class="table text-center w-100 mx-auto border shadow">
            <tbody>
                <tr>
                    <th class="border table-active p-3">Name</th>
                    <td class="p-3"><?= $credentials[1] ?></td>
                </tr>
                <tr>
                    <th class="border table-active p-3">Age</th>
                    <td class="p-3"><?= $credentials[2] ?></td>
                </tr>
                <tr>
                    <th class="border table-active p-3">Email</th>
                    <td class="p-3"><?= $credentials[3] ?></td>
                </tr>
                <tr>
                    <th class="border table-active p-3">GPA</th>
                    <td class="p-3"><?= $credentials[4] ?></td>
                </tr>
            </tbody>
        </table>


    </div>

</body>

</html>