<?php


class AuthenticationCtrl extends Authentication {


    public function fetchLogin($email, $password) {

        $this->validateLogin($email,$password);

    }

    public function setStudent($name, $age, $email, $password) {

        $this->validateInput($name, $age, $email, $password);

        echo "checking";

        $this->studentSignup($name, $age, $email, $password);

        echo "student";

    }

    private function validateInput($name = null, $age = null, $email, $password) {

        if(empty($name) || empty($age) || empty($email) || empty($password)) {

            header("location: ../../index.php?error=missingInputs");
            exit();

        }


    }

}