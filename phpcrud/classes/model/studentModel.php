<?php

class Student extends Dbh {

    protected function getUser($studentID) {

        $sql = "SELECT * FROM `student` WHERE id = ?";

        $stmt = $this->connect()->prepare($sql);

        if(!$stmt->execute([$studentID])) {
            header("location: ../index.php?error=stmtFailed");
            exit();
        }

        // if($stmt->rowCount() == 0) {
        //     header("location: ../index.php?error=userNotFound");
        //     exit();
        // }

        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $result;

    }


    // protected function setStudent($name, $age, $email, $password)
    // {

    //     $sql = "INSERT INTO `student`(`name`,`age`,`email`) VALUES(?,?,?)";

    //     $stmt = $this->connect()->prepare($sql);

    //     if (!$stmt->execute([$name, $age, $email])) {

    //         header("location: ../../studentform.php?error=stmtFailed");
    //         exit();
    //     }

    //     $sql2 = "INSERT INTO `login`(`password`,`user_type`,`student_id`) VALUES (?,?,?)";

    //     $stmt2 = $this->connect()->prepare($sql2);


    //     if (!$stmt2->execute([$password, $age, $email])) {

    //         header("location: ../../studentform.php?error=stmtFailed");
    //         exit();
    //     }

    // }

}