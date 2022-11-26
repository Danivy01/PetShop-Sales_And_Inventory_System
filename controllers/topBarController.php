<?php

include ('models/database.php');
include ('models/details.php');

if (isset($_SESSION['userId']))
{
    $details = new Details($_SESSION);

    $empDetails = $details->getEmployeeDetails();

    // Employee Details
    $firstName = $empDetails[0]['firstName'];
    $middleName = $empDetails[0]['middleName'];
    $lastName = $empDetails[0]['lastName'];
    $gender = $empDetails[0]['gender'];
    $emailAddress = $empDetails[0]['emailAddress'];
    $phoneNumber = $empDetails[0]['phoneNumber'];
    $positionName = $details->positionName($empDetails[0]['positionId']);
    $hiredDate = date('F d, Y', strtotime($empDetails[0]['hiredDate']));
    $location = $empDetails[0]['location'];

    // Access Fields
    $type = $details->access();
    $typeName = $type[0]['type'];
    $accessType = ($type[0]['accessType'] == 0) ? "All" : "User";

    // positions

    $position = $details->allPosition(1);

    // Records

    $empCount = $details->employeeCount();
    $customerCount = $details->customerCount();
    $userCount = $details->userCount();

    // Table Data

    if (isset($_GET['page'])) 
    {
        // Customer Table
        if ($_GET['page'] == 1)
        {
            $customerTable = $details->customerTable();
        }

        // Employee Table
        if ($_GET['page'] == 2)
        {
            $employeeTable = $details->employeeTable();
        }
        
        // Accounts Table
        if ($_GET['page'] == 7)
        {
            $adminTable = $details->accountsTable()['admin'];
            $userTable = $details->accountsTable()['users'];
        }

        if ($_GET['page'] == 8)
        {
            $id = $_GET['id'];
            $randomId = $_SESSION['randomId'];

            $settings = $details->userSettings($id, $randomId);
        }
    }
}