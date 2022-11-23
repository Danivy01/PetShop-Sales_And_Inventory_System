<?php

include('../models/database.php');
include('../models/details.php');

session_start();

$info = new Details($_SESSION);

if (isset($_POST['addCustomer']))
{
    $data = array(
        'firstName'     => isset($_POST['firstname']) ? $_POST['firstname'] : '',
        'lastName'      => isset($_POST['lastname']) ? $_POST['lastname'] : '',
        'phoneNumber'   => isset($_POST['phonenumber']) ? $_POST['phonenumber'] : '',
    );

    echo $info->insertCustomer($data);
}

if (isset($_POST['editCustomerValue']))
{
    $id = isset($_POST['id']) ? $_POST['id'] : '';

    echo $info->customerModal($id);
}

if (isset($_POST['editCustomer']))
{
    $data = array(
        'id'            => isset($_POST['id']) ? $_POST['id'] : '',
        'firstName'     => isset($_POST['firstname']) ? $_POST['firstname'] : '',
        'lastName'      => isset($_POST['lastname']) ? $_POST['lastname'] : '',
        'phoneNumber'   => isset($_POST['phonenumber']) ? $_POST['phonenumber'] : '',
    );

    echo $info->updateCustomer($data);
}