<?php


include "../classes/dbh.php";
include "../classes/model/authenticationModel.php";
include "../classes/controller/authenticationCtrl.php";


$authenticator = new AuthenticationCtrl();

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if ($_POST['login']) {
        validateLogin($authenticator);
    } elseif ($_POST['signup']) {
        validateSignup($authenticator);
    }
}

function validateLogin($authenticator)
{

    $email = $_POST['email'];
    $password = $_POST['password'];

    // echo $email;
    $authenticator->fetchLogin($email, $password);

}

function validateSignup($authenticator)
{

    $name = $_POST['name'];
    $age = $_POST['age'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    $authenticator->setStudent($name, $age, $email, $password);

}
