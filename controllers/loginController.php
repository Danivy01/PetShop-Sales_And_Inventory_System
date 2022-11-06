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

    if (strpos($id, 'success') !== false)
    {
        $id = str_replace('success', '', $id);
        $_SESSION['randomId'] = $id;
        echo 2;
    }
    else
    {
        echo $id;
    }
}