<?php
include "../classes/dbh.php";
include "../classes/model/adminModel.php";
include "../classes/view/adminView.php";

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Manage Records</title>
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.css">

    <script src="../bootstrap/js/bootstrap.js"></script>
    <script src="js/ajax.js" defer></script>

</head>

<body class="container mt-5">


    <div class="container container-fluid p-5">
        <div class="row d-flex align-items-center mb-4 border-bottom">
            <div class="col-11">
                <h1 class="">Manage Records</h1>
            </div>
            <div class="col-1"><a href="../form_handlers/logout.php" class="btn btn-primary">Logout</a></div>
        </div>
        <div class="table-responsive">
            <table class="table table-striped border table-hover text-center">
                <thead class="p-2">
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Age</th>
                        <th>Email</th>
                        <th>GPA</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody id="table-contents">


                </tbody>


            </table>

            <!-- Modal -->
            <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="staticBackdropLabel"></h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div id="formData">

                            </div>
                        </div>
                        <div class="modal-footer">
                            <div class="wrapper w-100 d-flex flex-column justify-content-center gap-2">
                                <button type="submit" class="btn btn-warning confirm" data-bs-dismiss="modal">Confirm</button>
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Back</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>

</html>