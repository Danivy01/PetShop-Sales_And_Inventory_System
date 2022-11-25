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

if (isset($_POST['addEmployee']))
{
    $data = array(
        'firstname'     => isset($_POST['firstname']) ? $_POST['firstname'] : '',
        'middleName'    => isset($_POST['middlename']) ? $_POST['middlename'] : '',
        'lastname'      => isset($_POST['lastname']) ? $_POST['lastname'] : '',
        'gender'        => isset($_POST['gender']) ? $_POST['gender'] : '',
        'email'         => isset($_POST['email']) ? $_POST['email'] : '',
        'phonenumber'   => isset($_POST['phonenumber']) ? $_POST['phonenumber'] : '',
        'position'      => isset($_POST['position']) ? $_POST['position'] : '',
        'dateHired'     => isset($_POST['FromDate']) ? $_POST['FromDate'] : '',
        'address'       => isset($_POST['address']) ? $_POST['address'] : '',
        'province'      => isset($_POST['province']) ? $_POST['province'] : '',
        'city'          => isset($_POST['city']) ? $_POST['city'] : '',
    );

    echo $info->insertEmployee($data);
}

if (isset($_POST['addProduct']))
{
    $data = array(
        'productCode'     => isset($_POST['productCode']) ? $_POST['productCode'] : '',
        'productName'      => isset($_POST['productName']) ? $_POST['productName'] : '',
        'productDescription'   => isset($_POST['productDescription']) ? $_POST['productDescription'] : '',
        'qtyStock'      => isset($_POST['qtyStock']) ? $_POST['qtyStock'] : '',
        'onHand'      => isset($_POST['onHand']) ? $_POST['onHand'] : '',
        'price'      => isset($_POST['price']) ? $_POST['price'] : '',
        'category_id'      => isset($_POST['category_id']) ? $_POST['category_id'] : '',
        'supplier_id'      => isset($_POST['supplier_id']) ? $_POST['supplier_id'] : '',
        'date_stock_in'      => isset($_POST['FromDate']) ? $_POST['FromDate'] : '',
    );

    echo $info->insertProduct($data);
}

if (isset($_POST['addSupplier']))
{
    $data = array(
        'companyName'     => isset($_POST['companyName']) ? $_POST['companyName'] : '',
        'province'      => isset($_POST['province']) ? $_POST['province'] : '',
        'city'      => isset($_POST['city']) ? $_POST['city'] : '',
        'phoneNumber'   => isset($_POST['phoneNumber']) ? $_POST['phoneNumber'] : '',
    );

    echo $info->insertSupplier($data);
}