<?php

include('../models/database.php');
include('../models/details.php');

session_start();

$export = new Details($_SESSION);

if (isset($_GET['export']))
{
    $name = "";
    $type = isset($_GET['type']) ? $_GET['type'] : '';

    if ($type == "customerExcel")
    {
        $name = "Customer Data";
    }
    else if ($type == "employeeExcel")
    {
        $name = "Employee Data";
    }
    else if ($type == "supplierExcel")
    {
        $name = "Supplier Data";
    }
    else if ($type == "productExcel")
    {
        $name = "Product Data";
    }
    else if ($type == "inventoryExcel")
    {
        $name = "Inventory Data";
    }
    else if ($type == "transactionExcel")
    {
        $name = "Transaction Data";
    }

    $exportData = $export->export($type);

    $filename = $name . " " . date('Y-m-d') . ".xls";
 
    header("Content-Type: application/vnd.ms-excel");
    header("Content-Disposition: attachment; filename=\"$filename\"");
    echo $exportData;
}
