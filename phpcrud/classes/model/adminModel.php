<?php
session_start();



class Admin extends Dbh
{


    protected function getStudents()
    {

        $sql = "SELECT * FROM `student` INNER JOIN `login` ON student.id = login.student_id WHERE login.user_type = 'student'";


        $stmt = $this->connect()->prepare($sql);

        if (!$stmt->execute()) {

            header("location: ../admin/admincrud.php?error=stmtFailed");
            exit();
        }

        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $result;
    }

    protected function getStudent($studentID)
    {

        $sql = "SELECT * FROM `student` WHERE id = ?";

        $stmt = $this->connect()->prepare($sql);

        if (!$stmt->execute([$studentID])) {

            header("location: ../admin/admincrud.php?error=stmtFailed");
            exit();
        }

        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $result;
    }


    protected function updateStudent($studentID, $name, $age, $gpa)
    {

        $sql = "UPDATE `student` SET name = ?, age = ?, gpa = ? WHERE id = ?";

        $stmt = $this->connect()->prepare($sql);

        if (!$stmt->execute([$name, $age, $gpa, $studentID])) {
            header("location: ../admin/admincrud.php?error=stmtFailed");
            exit();
        }


        $_SESSION['state'] = "Student Successfully Updated";

        // header("location: ../admin/admincrud.php");
        // exit();
    }


    protected function removeStudent($studentID)
    {

        $sql = "DELETE FROM `student` WHERE id = ?";

        $stmt = $this->connect()->prepare($sql);

        if (!$stmt->execute([$studentID])) {
            header("location: ../admin/admincrud.php?error=stmtFailed");
            exit();
        }

        $_SESSION['state'] = "Student Successfully Removed";


        // header("location: ../admin/admincrud.php");
        // exit();
    }
}
