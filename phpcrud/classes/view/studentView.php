<?php

class StudentView extends Student
{

    public function fetchCredentials($studentID)
    {

        $studentRecord = $this->getUser($studentID);

        $userCredentials = [];

        foreach ($studentRecord as $credential) {
            foreach ($credential as $data) {
                array_push($userCredentials, $data);
            }
        }

        return $userCredentials;
    }
}
