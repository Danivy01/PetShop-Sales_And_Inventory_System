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

if (isset($_POST['getEmp']))
{
    $id = isset($_POST['id']) ? $_POST['id'] : '';

    echo $info->employeeModal($id);
}

if (isset($_POST['editEmployee']))
{
    $data = array(
        'id'            => isset($_POST['editIdEmp']) ? $_POST['editIdEmp'] : '',
        'firstname'     => isset($_POST['firstname']) ? $_POST['firstname'] : '',
        'middleName'    => isset($_POST['middleName']) ? $_POST['middleName'] : '',
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

    echo $info->updateEmployee($data);
    // print_r($data);
}

if (isset($_POST['editSettings']))
{
    $data = array(
        'id'            => isset($_POST['id']) ? $_POST['id'] : '',
        'firstname'     => isset($_POST['firstname']) ? $_POST['firstname'] : '',
        'middleName'    => isset($_POST['middlename']) ? $_POST['middlename'] : '',
        'lastname'      => isset($_POST['lastname']) ? $_POST['lastname'] : '',
        'gender'        => isset($_POST['gender']) ? $_POST['gender'] : '',
        'email'         => isset($_POST['email']) ? $_POST['email'] : '',
        'phonenumber'   => isset($_POST['phone']) ? $_POST['phone'] : '',
        'dateHired'     => isset($_POST['hireddate']) ? $_POST['hireddate'] : '',
        'address'       => isset($_POST['address']) ? $_POST['address'] : '',
        'province'      => isset($_POST['province']) ? $_POST['province'] : '',
        'city'          => isset($_POST['city']) ? $_POST['city'] : '',
    );

    $user = array(
        'user'         => isset($_POST['username']) ? $_POST['username'] : '',
        'password'     => isset($_POST['password']) ? $_POST['password'] : '',
        'randomId'     => isset($_POST['randomId']) ? $_POST['randomId'] : '',
    );

    echo $info->updateSettings($data, $user);
}

if (isset($_POST['addUser']))
{
    $data = array(
        'userId'          => isset($_POST['selectUser']) ? $_POST['selectUser'] : '',
        'typeId'          => isset($_POST['selectType']) ? $_POST['selectType'] : '',
        'userName'        => isset($_POST['userName']) ? $_POST['userName'] : '',
        'password'        => isset($_POST['password']) ? $_POST['password'] : '',
    );

    echo $info->addUser($data);
}

if (isset($_POST['editAdminModal']))
{
    $id = isset($_POST['id']) ? $_POST['id'] : '';

    echo $info->editUserModal($id);
}

if (isset($_POST['editUserModal']))
{
    $id = isset($_POST['id']) ? $_POST['id'] : '';

    echo $info->editUserModal($id);
}

if (isset($_POST['updateUser']))
{
    $data = array(
        'userId'             => isset($_POST['editId']) ? $_POST['editId'] : '',
        'user'               => isset($_POST['editUserName']) ? $_POST['editUserName'] : '',
        'password'           => isset($_POST['editPassword']) ? $_POST['editPassword'] : '',
    );

    echo $info->updateUser($data);
}

if (isset($_POST['deleteUser']))
{
    $id = isset($_POST['id']) ? $_POST['id'] : '';

    echo $info->deleteUser($id);
}

if (isset($_POST['addSupplier']))
{
    $data = array(
        'companyName'           => isset($_POST['companyName']) ? $_POST['companyName'] : '',
        'phoneNumber'           => isset($_POST['companyPhone']) ? $_POST['companyPhone'] : '',
        'province'              => isset($_POST['supplierProvince']) ? $_POST['supplierProvince'] : '',
        'city'                  => isset($_POST['supplierCity']) ? $_POST['supplierCity'] : '',
    );

    echo $info->addSupplier($data);
}

if (isset($_POST['getSupplier']))
{
    $id = isset($_POST['id']) ? $_POST['id'] : '';

    echo $info->supplierModal($id);
}

if (isset($_POST['updateSupplier']))
{
    $data = array(
        'id'            => isset($_POST['supplierEditId']) ? $_POST['supplierEditId'] : '',
        'companyName'   => isset($_POST['editCompanyName']) ? $_POST['editCompanyName'] : '',
        'phoneNumber'   => isset($_POST['editCompanyPhone']) ? $_POST['editCompanyPhone'] : '',
        'province'      => isset($_POST['editSupplierProvince']) ? $_POST['editSupplierProvince'] : '',
        'city'          => isset($_POST['editSupplierCity']) ? $_POST['editSupplierCity'] : '',
    );

    echo $info->updateSupplier($data);
}

if (isset($_POST['deleteSupplier']))
{
    $id = isset($_POST['id']) ? $_POST['id'] : '';

    echo $info->deleteSupplier($id);
}

if (isset($_POST['addCategory']))
{
    $data = array(
        'categoryName'          => isset($_POST['categoryName']) ? $_POST['categoryName'] : '',
        'status'                => isset($_POST['categoryStatus']) ? $_POST['categoryStatus'] : '',
    );

    echo $info->addCategory($data);
}

if (isset($_POST['deleteCategory']))
{
    $id = isset($_POST['id']) ? $_POST['id'] : '';
}

if (isset($_POST['changeStatus']))
{
    $text = isset($_POST['text']) ? $_POST['text'] : '';

    $status = ($text == "Active") ? 0 : 1;

    $data = array(
        'id'           => isset($_POST['id']) ? $_POST['id'] : '',
        'status'       => $status,
    );

    echo $info->changeCategoryStatus($data);
}

if (isset($_POST['addProduct']))
{
    $data = array(
        'productCode'           => isset($_POST['productCode']) ? $_POST['productCode'] : '',
        'productName'           => isset($_POST['productName']) ? $_POST['productName'] : '',
        'productDescription'    => isset($_POST['productDescription']) ? $_POST['productDescription'] : '',
        'stock'                 => isset($_POST['stock']) ? $_POST['stock'] : '',
        'onHand'                => isset($_POST['onHand']) ? $_POST['onHand'] : '',
        'price'                 => isset($_POST['price']) ? $_POST['price'] : '',
        'category'              => isset($_POST['categorySelect']) ? $_POST['categorySelect'] : '',
        'supplier'              => isset($_POST['supplierSelect']) ? $_POST['supplierSelect'] : '',
    );

    echo $info->addProduct($data);
}

if (isset($_POST['deleteProduct']))
{
    $id = isset($_POST['id']) ? $_POST['id'] : '';

    echo $info->deleteProduct($id);
}