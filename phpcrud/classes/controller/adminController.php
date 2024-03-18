<?php

class AdminCtrl extends Admin
{


    public function updateStudentRecord($name, $age, $gpa, $studentID)
    {


        echo "attempt";
        if ($this->checkEmptyInputs($name, $age, $gpa)) {

            header("location: ../admin/admincrud.php?error=missingInputs");
            exit();
        }



        $this->updateStudent($name, $age, $gpa, $studentID);
    }


    public function deleteStudent($studentID)
    {


        $this->removeStudent($studentID);
    }


    private function checkEmptyInputs($name, $age, $gpa)
    {

        if (empty($name) || empty($age) || empty($gpa)) {
            return true;
        }

        return false;
    }
}
