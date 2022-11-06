<?php

include('../models/database.php');
include('../models/login.php');

session_start();

$login = new Login();

if (isset($_POST['login']))
{
    $data = array(
        'user'      =>      isset($_POST['user']) ? $_POST['user'] : '',
        'password'  =>      isset($_POST['password']) ? $_POST['password'] : ''
    );

    $id = $login->authorizeUser($data);

    if (is_array($id))
    {
        $_SESSION['randomId'] = $id[0]['randomId'];
        $_SESSION['userId'] = $id[0]['userId'];
        $_SESSION['typeId'] = $id[0]['typeId'];
        echo 2;
    }
    else
    {
        echo $id;
    }
}