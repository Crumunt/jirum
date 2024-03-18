<?php

class AdminView extends Admin {

    public function fetchStudents() {

        $studentRecords = $this->getStudents();

        return $studentRecords;

    }

    public function fetchStudent($studentID) {

        $studentRecord = $this->getStudent($studentID);

        return $studentRecord;

    }

}