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
    $supplierCount = $details->supplierCount();

    $noAccounts = $details->getUserNoAccounts();

    $category = $details->getCategory();
    $productCode = $category[0];
    $selectCategory = $category[1];
    $selectSupplier = $category[2];
    
    $categoryTable = $details->categoryTable();

    // Recent Products
    $recent = $details->recentProducts();
    $productCount = $details->productCount();

    // Transaction Count
    $transactionCount = $details->transactionCount();

    // Table Data

    if (isset($_GET['page'])) 
    {
        if ($accessType == "User")
        {
            if ($_GET['page'] != 6 AND $_GET['page'] != 8)
            {
                echo "<script>alert('You are not allowed to access this page!'); window.location.href='index.php';</script>";
            }
        }

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

        // Inventory Table
        if ($_GET['page'] == 3)
        {
            $inventoryTable = $details->inventoryTable();
        }

        // Product
        if ($_GET['page'] == 4)
        {
            $productTable = $details->productTable();
        }

        // Supplier Table
        if ($_GET['page'] == 5)
        {
            $supplierTable = $details->supplierTable();
        }

        // Transaction Table
        if ($_GET['page'] == 6)
        {
            $transactionTable = $details->transactionTable();
        }
        
        // Accounts Table
        if ($_GET['page'] == 7)
        {
            $adminTable = $details->accountsTable()['admin'];
            $userTable = $details->accountsTable()['users'];
            $accessFields = $details->getAccessType();
        }

        if ($_GET['page'] == 8)
        {
            $id = $_GET['id'];
            $randomId = $_SESSION['randomId'];

            $settings = $details->userSettings($id, $randomId);
        }
    }
}