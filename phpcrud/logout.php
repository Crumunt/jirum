<?php

@include 'config.php';

session_start();
unset($_SESSION['student_name']);
session_destroy();

header('location:index.php');

?>