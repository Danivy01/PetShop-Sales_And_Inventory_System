<?php
class Details extends Database
{
    function __construct($session)
    {
        $this->id = $session['userId'];
        $this->typeId = $session['typeId'];
    }

    public function getEmployeeDetails() // method to get the employee details
    {
        return $this->employeeDetails($this->id);
    }

    public function positionName($posId, $type = 0) // Method for getting the position name
    {
        return $this->position($posId, $type);
    }

    public function allPosition($type) // Method to get all the positions
    {
        return $this->position("", $type);
    }

    public function access() // method to get the user access
    {
        return $this->accessFields($this->typeId);
    }

    public function employeeTable()
    {
        $table = "";
        $empDetails = $this->employeeDetails("", 1);
        
        foreach ($empDetails AS $emp)
        {
            $table .= "<tr>";
            $table .= "<td class='text-center'>" . $emp['firstName'] . "</td>";
            $table .= "<td class='text-center'>" . $emp['middleName'] . "</td>";
            $table .= "<td class='text-center'>" . $emp['lastName'] . "</td>";
            $table .= "<td class='text-center'>" . $emp['positionName'] . "</td>";
            $table .= "<td class='text-center'><a href='#' data-toggle='modal' data-id='" . $emp['id'] . "' data-target='#editEmployeeModal' type='button' class='btn btn-primary bg-gradient-primary' style='border-radius: 0px;'><i class='fas fa-fw fa-edit'></i></a></td>";
        }

        return $table;
    }

    public function accountsTable()
    {
        $adminTable = "";
        $userTable = "";

        $accounts = $this->userTable();
        $adminCount = $userCount = 0;

        foreach ($accounts AS $acc)
        {
            $empDetails = $this->employeeDetails($acc['userId']);
            $accessField = $this->accessFields($acc['typeId']);
            $accessType = $accessField[0]['accessType'];
            $typeName = $accessField[0]['type'];
            $name = $empDetails[0]['firstName'] . " " . $empDetails[0]['middleName'] . " " . $empDetails[0]['lastName'];

            if ($accessType == 0)
            {
                ++$adminCount;

                if ($adminCount > 0)
                {
                    $adminTable .= "<tr>";
                    $adminTable .= "<td class='text-center'>" . $name . "</td>";
                    $adminTable .= "<td class='text-center'>" . $acc['userName'] . "</td>";
                    $adminTable .= "<td class='text-center'>" . $typeName . "</td>";
                    $adminTable .= "<td class='text-center'><a href='#' data-toggle='modal' data-target='#accountModal' data-id='" . $acc['id'] . "' type='button' class='btn btn-primary bg-gradient-primary' style='border-radius: 0px;'><i class='fas fa-fw fa-edit'></i></a></td>";
                    $adminTable .= "</tr>";
                }
                else
                {
                    $adminTable = "<tr><td colspan='4' class='text-center'>No records found.</td></tr>";
                }
            }
            else
            {
                ++$userCount;

                if ($userCount > 0)
                {
                    $userTable .= "<tr>";
                    $userTable .= "<td class='text-center'>" . $name . "</td>";
                    $userTable .= "<td class='text-center'>" . $acc['username'] . "</td>";
                    $userTable .= "<td class='text-center'>" . $typeName . "</td>";
                    $userTable .= "<td class='text-center'><a href='#' data-toggle='modal' data-target='#accountModal' data-id='" . $acc['id'] . "' type='button' class='btn btn-primary bg-gradient-primary' style='border-radius: 0px;'><i class='fas fa-fw fa-edit'></i></a></td>";
                    $userTable .= "</tr>";
                }
                else
                {
                    $userTable .= "<tr>";
                    $userTable .= "<td colspan='4' class='text-center'>No user accounts yet.</td>";
                    $userTable .= "</tr>";
                }
            }
        }

        return array('admin' => $adminTable, 'users' => $userTable);
    }

    public function insertCustomer($data)
    {
        return $this->customerDetails(1, $data);
    }

    public function customerTable()
    {
        $customerTable = "";

        $customer = $this->customerDetails();

        if (count($customer) > 0)
        {
            foreach ($customer AS $cust)
            {
                $customerTable .= "<tr>";
                $customerTable .= "<td class='text-center'>" . $cust['firstName'] . "</td>";
                $customerTable .= "<td class='text-center'>" . $cust['lastName'] . "</td>";
                $customerTable .= "<td class='text-center'>" . $cust['phoneNumber'] . "</td>";
                $customerTable .= "<td class='text-center'><a href='#' data-toggle='modal' data-target='#editCustomerModal' data-id='" . $cust['id'] . "' type='button' class='btn btn-primary bg-gradient-primary editCust' style='border-radius: 0px;'><i class='fas fa-fw fa-edit'></i></a></td>";
                $customerTable .= "</tr>";
            }
        }
        else
        {
            $customerTable .= "<tr>";
            $customerTable .= "<td colspan='4' class='text-center'>No records found.</td>";
            $customerTable .= "</tr>";
        }

        return $customerTable;
    }

    public function customerModal($id)
    {
        $customerDetails = $this->customerDetails(0, array('id' => $id));

        return json_encode([
            'firstName' => $customerDetails[0]['firstName'],
            'lastName' => $customerDetails[0]['lastName'],
            'phoneNumber' => $customerDetails[0]['phoneNumber'],
            'id' => $customerDetails[0]['id']
        ]);
    }

    public function updateCustomer($data)
    {
        return $this->customerDetails(2, $data);
    }

    public function export($type)
    {
        $table = "";

        if ($type == "customerExcel")
        {
            $table .= "<table border=1>";
            $table .= "<tr>";
            $table .= "<th colspan='3'>List of Customers for ".date("F j, Y")."</th>";
            $table .= "</tr>";
            $table .= "<tr>";
            $table .= "<th>First Name</th>";
            $table .= "<th>Last Name</th>";
            $table .= "<th>Phone Number</th>";
            $table .= "</tr>";

            $customer = $this->customerDetails();

            if (count($customer) > 0)
            {
                foreach ($customer AS $cust)
                {
                    $table .= "<tr>";
                    $table .= "<td>" . $cust['firstName'] . "</td>";
                    $table .= "<td>" . $cust['lastName'] . "</td>";
                    $table .= "<td>'" . $cust['phoneNumber'] . "</td>";
                    $table .= "</tr>";
                }
            }
            else
            {
                $table .= "<tr>";
                $table .= "<td colspan='3' class='text-center'>No records found.</td>";
                $table .= "</tr>";
            }

            $table .= "</table>";
        }
        else if ($type == "employeeExcel")
        {
            $table .= "<table border=1>";
            $table .= "<tr>";
            $table .= "<th colspan='4'>List of Employees for ".date("F j, Y")."</th>";
            $table .= "</tr>";
            $table .= "<tr>";
            $table .= "<th>Name</th>";
            $table .= "<th>Username</th>";
            $table .= "<th>Access Type</th>";
            $table .= "<th>Created At</th>";
            $table .= "</tr>";

            $employee = $this->employeeDetails("", 1);

            if (count($employee) > 0)
            {
                foreach ($employee AS $emp)
                {
                    $table .= "<tr>";
                    $table .= "<td>" . $emp['firstName'] . "</td>";
                    $table .= "<td>" . $emp['middleName'] . "</td>";
                    $table .= "<td>" . $emp['lastName'] . "</td>";
                    $table .= "<td>" . $emp['position'] . "</td>";
                    $table .= "</tr>";
                }
            }
            else
            {
                $table .= "<tr>";
                $table .= "<td colspan='4' class='text-center'>No records found.</td>";
                $table .= "</tr>";
            }

            $table .= "</table>";
        }

        return $table;
    }

    public function insertEmployee($data)
    {
        return $this->employeeDetails("", 2, $data);
    }

    public function insertProduct($data)
    {
        return $this->productDetails(1, $data);
    }

    public function productTable()
    {
        $productTable = "";

        $product = $this->productDetails();

        if (count($product) > 0)
        {
            foreach ($product AS $prod)
            {
                $productTable .= "<tr>";
                $productTable .= "<td class='text-center'>" . $prod['productCode'] . "</td>";
                $productTable .= "<td class='text-center'>" . $prod['productName'] . "</td>";
                $productTable .= "<td class='text-center'>" . $prod['productDescription'] . "</td>";
                $productTable .= "<td class='text-center'>" . $prod['qtyStock'] . "</td>";
                $productTable .= "<td class='text-center'>" . $prod['onHand'] . "</td>";
                $productTable .= "<td class='text-center'>" . $prod['price'] . "</td>";
                $productTable .= "<td class='text-center'>" . $prod['category_id'] . "</td>";
                $productTable .= "<td class='text-center'>" . $prod['supplier_id'] . "</td>";
                $productTable .= "<td class='text-center'>" . $prod['date_stock_in'] . "</td>";
                $productTable .= "<td class='text-center'><a href='#' data-toggle='modal' data-target='#editCustomerModal' data-id='" . $prod['id'] . "' type='button' class='btn btn-primary bg-gradient-primary editCust' style='border-radius: 0px;'><i class='fas fa-fw fa-edit'></i></a></td>";
                $productTable .= "</tr>";
            }
        }
        else
        {
            $productTable .= "<tr>";
            $productTable .= "<td colspan='4' class='text-center'>No records found.</td>";
            $productTable .= "</tr>";
        }

        return $productTable;
    }

    public function productModal($id)
    {
        $productDetails = $this->productDetails(0, array('id' => $id));

        return json_encode([
            'productCode' => $productDetails[0]['productCode'],
            'productName' => $productDetails[0]['productName'],
            'productDescription' => $productDetails[0]['productDescription'],
            'qtyStock' => $productDetails[0]['qtyStock'],
            'onHand' => $productDetails[0]['onHand'],
            'price' => $productDetails[0]['price'],
            'category_id' => $productDetails[0]['category_id'],
            'supplier_id' => $productDetails[0]['supplier_id'],
            'date_stock_in' => $productDetails[0]['date_stock_in'],
            'product_id' => $productDetails[0]['product_id']
        ]);
    }

    public function updateProduct($data)
    {
        return $this->productDetails(2, $data);
    }

    public function insertSupplier($data)
    {
        return $this->supplierDetails(1, $data);
    }

    public function supplierTable()
    {
        $supplierTable = "";

        $supplier = $this->supplierDetails();

        if (count($supplier) > 0)
        {
            foreach ($supplier AS $supp)
            {
                $supplierTable .= "<tr>";
                $supplierTable .= "<td class='text-center'>" . $supp['companyName'] . "</td>";
                $supplierTable .= "<td class='text-center'>" . $supp['province'] . "</td>";
                $supplierTable .= "<td class='text-center'>" . $supp['city'] . "</td>";
                $supplierTable .= "<td class='text-center'>" . $supp['phoneNumber'] . "</td>";
                $supplierTable .= "<td class='text-center'><a href='#' data-toggle='modal' data-target='#editCustomerModal' data-id='" . $supp['supplier_id'] . "' type='button' class='btn btn-primary bg-gradient-primary editCust' style='border-radius: 0px;'><i class='fas fa-fw fa-edit'></i></a></td>";
                $supplierTable .= "</tr>";
            }
        }
        else
        {
            $supplierTable .= "<tr>";
            $supplierTable .= "<td colspan='4' class='text-center'>No records found.</td>";
            $supplierTable .= "</tr>";
        }

        return $supplierTable;
    }

    public function supplierModal($supplier_id)
    {
        $supplierDetails = $this->supplierDetails(0, array('supplier_id' => $supplier_id));

        return json_encode([
            'companyName' => $supplierDetails[0]['companyName'],
            'province' => $supplierDetails[0]['province'],
            'city' => $supplierDetails[0]['city'],
            'phoneNumber' => $supplierDetails[0]['phoneNumber'],
            'supplier_id' => $supplierDetails[0]['supplier_id']
        ]);
    }

    public function updateSupplier($data)
    {
        return $this->supplierDetails(2, $data);
    }
}