<?php

session_start();

class Authentication extends Dbh
{

    private function checkUser($email)
    {

        $sql = "SELECT * FROM `student` INNER JOIN `login` ON student.id = login.student_id WHERE student.email = ?";

        $stmt = $this->connect()->prepare($sql);

        if (!$stmt->execute(array($email))) {

            header("location: ../index.php?error=stmtFailed");
            exit();
        }

        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        
        return $result;

    }

    protected function validateLogin($email, $password)
    {


        $result = $this->checkUser($email);

        $hashedPassword = $result[0]['password'];


        if (password_verify($password, $hashedPassword)) {

            session_start();

            $_SESSION['userID'] = $result[0]['student_id'];
            $_SESSION['role'] = $result[0]['user_type'];

            $redirect = ($result[0]['user_type'] == 'admin') ? "../admin/admincrud.php" : "../user/viewstudent.php";

            // echo "password correct";
            header("location: $redirect");
            exit();
        } else {

            header("location: ../index.php?error=invalidUsernameOrPassword");
            exit();
        }
    }

    protected function studentSignup($name, $age, $email, $password)
    {
        $result = $this->checkUser($email);

        if ($result) {

            header("location: ../index.php?error=userAlreadyExists");
            exit();
        }

        $sql = "INSERT INTO `student`(`name`,`age`,`email`) VALUES (?, ?, ?)";

        $stmt = $this->connect()->prepare($sql);

        if (!$stmt->execute([$name, $age, $email])) {

            header("location: ../index.php?error=stmtFailed");
            exit();
        }

        $sql2 = "INSERT INTO `login`(`password`,`user_type`,`student_id`) VALUES( ?, ?, ?)";

        $stmt2 = $this->connect()->prepare($sql2);

        $result = $this->getLastId();

        $studentID = $result[0]["id"];
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $user_type = "student";


        if (!$stmt2->execute([$hashedPassword, $user_type, $studentID])) {

            header("location: ../index.php?error=stmtFailed");
            exit();
        }

        header("location: ../index.php?error=none");
        exit();
    }

    function getLastId() {
        $idSql = "SELECT id FROM `student` ORDER BY id DESC LIMIT 1";

        $idStmt = $this->connect()->prepare($idSql);

        $idStmt->execute();

        $result = $idStmt->fetchAll(PDO::FETCH_ASSOC);

        return $result;
    }
}