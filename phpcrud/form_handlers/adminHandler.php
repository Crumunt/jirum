<?php

include '../classes/dbh.php';
include '../classes/model/adminModel.php';
include '../classes/controller/adminController.php';
include '../classes/view/adminView.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    
    if (isset($_POST['updateID'])) {
        $adminCtrl = new AdminCtrl();
        


        updateStudent($adminCtrl);

        // echo $_POST['name'];
        
    }elseif (isset($_POST['delID'])) {

        $adminCtrl = new AdminCtrl();
        
        confirmRemoveStudent($adminCtrl);
        
    }elseif (isset($_POST['loadAll'])) {
        
        $adminView = new AdminView();
        loadStudents($adminView);

    }
} elseif ($_SERVER['REQUEST_METHOD'] == 'GET') {

    $adminView = new AdminView();

    $action = $_GET['action'] ?? NULL;

    if ($action == 'showData') {
        $id = $_GET['id'] ?? NULL;
        getStudent($id, $adminView);
    } else {
        $confirmID = $_GET['confirmDelID'];
        promptRemoveStudent($confirmID, $adminView);
    }
}


function loadStudents($adminView)
{
    $studentRecords = $adminView->fetchStudents();

    $studentCount = 1;

    foreach ($studentRecords as $value) {
?>
        <tr>
            <td><?= $studentCount++ ?></td>
            <td><?= $value['name'] ?></td>
            <td><?= $value['age'] ?></td>
            <td><?= $value['email'] ?></td>
            <td><?= number_format($value['gpa'], 2) ?></td>
            <td class="d-flex flex-column gap-1">
                <!-- <a href="edit.php?id=<?= $value['id'] ?>" class="btn btn-warning">Edit</a> -->
                <button type="button" class="btn btn-warning" value="<?= $value['student_id'] ?>" onclick="showData(this.value)" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                    Edit
                </button>
                <!-- <a href="edit.php?id=<?= $value['id'] ?>" class="btn btn-danger">Delete</a> -->
                <button type="button" class="btn btn-danger" value="<?= $value['student_id'] ?>" onclick="confirmDelete(this.value)" data-bs-toggle="modal" data-bs-target="#staticBackdrop">Delete</button>
            </td>
        </tr>
    <?php
    }
}

function updateStudent($adminCtrl)
{
    $studentID = $_POST['updateID'];
    $name = $_POST['name'];
    $age = $_POST['age'];
    $gpa = $_POST['gpa'];


    // echo $name;

    $adminCtrl->updateStudentRecord($studentID, $name, $age, $gpa);
}


function getStudent($studentID, $adminView)
{
    $studentRecord = $adminView->fetchStudent($studentID);

    ?>
    <div class="hidden">
        <input type="hidden" name="id" id="updateID" value="<?= $studentID ?>">
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
<?php
}


function promptRemoveStudent($studentID, $adminView)
{

    $studentRecord = $adminView->fetchStudent($studentID);

?>

    <div class="row">
        <h3>Are you sure you want to delete: <span class="fw-bold d-block"><?= $studentRecord[0]['name'] ?></h3>
    </div>

<?php

}

function confirmRemoveStudent($adminCtrl)
{   
    $studentID = $_POST['delID'];

    // echo $studentID;

    $adminCtrl->deleteStudent($studentID);
}
