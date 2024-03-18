<?php

include "../classes/dbh.php";
include "../classes/model/adminModel.php";
include "../classes/view/adminView.php";

$id = $_GET['id'];

$adminView = new AdminView();

$studentRecord = $adminView->fetchStudent($id);

// echo $_SERVER["REQUEST_METHOD"];

?>

<!-- <div class="hidden">
    <input type="hidden" name="id" value="<?= $id ?>">
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
    <button type="submit" class="btn btn-warning">Update</button>
    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Back</button>
</div> -->