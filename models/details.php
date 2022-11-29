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
            $table .= "<td class='text-center'><a href='#' data-toggle='modal' data-id='" . $emp['id'] . "' data-target='#editEmployeeModal' type='button' class='btn btn-primary bg-gradient-primary editEmp' style='border-radius: 0px;'><i class='fas fa-fw fa-edit'></i></a></td>";
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
                    $adminTable .= "<td class='text-center'><a href='#' data-toggle='modal' data-target='#editAdminModal' data-id='" . $empDetails[0]['id'] . "' type='button' class='btn btn-primary bg-gradient-primary editAdmin' style='border-radius: 0px;'><i class='fas fa-fw fa-edit'></i></a></td>";
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
                    $userTable .= "<td class='text-center'>" . $acc['userName'] . "</td>";
                    $userTable .= "<td class='text-center'>" . $typeName . "</td>";
                    $userTable .= "<td class='text-center'>
                                <a href='#' data-toggle='modal' data-target='#editUserModal' data-id='" . $empDetails[0]['id'] . "' type='button' class='btn btn-primary bg-gradient-primary editUser' style='border-radius: 0px;'><i class='fas fa-fw fa-edit'></i></a>
                                <a href='#' onclick='deleteUser($acc[id])' type='button' class='btn btn-danger bg-gradient-danger deleteUser' style='border-radius: 0px;'><i class='fas fa-fw fa-trash'></i></a>
                                </td>";
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

    public function supplierTable()
    {
        $table = "";

        $supplierDetails = $this->supplierDetails();

        if (count($supplierDetails) > 0)
        {
            foreach ($supplierDetails AS $supplier)
            {
                $table .= "<tr>";
                $table .= "<td class='text-center'>" . $supplier['companyName'] . "</td>";
                $table .= "<td class='text-center'>" . $supplier['province'] . "</td>";
                $table .= "<td class='text-center'>" . $supplier['city'] . "</td>";
                $table .= "<td class='text-center'>" . $supplier['phoneNumber'] . "</td>";
                $table .= "<td class='text-center'>
                        <a href='#' data-toggle='modal' data-target='#editSupplierModal' data-id='" . $supplier['supplier_id'] . "' type='button' class='btn btn-primary bg-gradient-primary editSupplier' style='border-radius: 0px;'><i class='fas fa-fw fa-edit'></i></a>
                        <a href='#' onclick='deleteSupplier($supplier[supplier_id])' type='button' class='btn btn-danger bg-gradient-danger deleteSupplier' style='border-radius: 0px;'><i class='fas fa-fw fa-trash'></i></a>
                        </td>";
                $table .= "</tr>";
            }
        }
        else
        {
            $table .= "<tr>";
            $table .= "<td colspan='5' class='text-center'>No records found.</td>";
            $table .= "</tr>";
        }

        return $table;
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
            $table .= "<th>Email Address</th>";
            $table .= "<th>Phone Number</th>";
            $table .= "<th>Position</th>";
            $table .= "<th>Date Hired</th>";
            $table .= "<th>Address</th>";
            $table .= "</tr>";

            $employee = $this->employeeDetails("", 1);

            if (count($employee) > 0)
            {
                foreach ($employee AS $emp)
                {
                    $table .= "<tr>";
                    $table .= "<td>" . $emp['firstName'] . " " . $emp['middleName'] . " " . $emp['lastName'] . "</td>";
                    $table .= "<td>" . $emp['emailAddress'] . "</td>";
                    $table .= "<td>'" . $emp['phoneNumber'] . "</td>";
                    $table .= "<td>" . $emp['positionName'] . "</td>";
                    $table .= "<td>" . date("F j, Y", strtotime($emp['hiredDate'])) . "</td>";
                    $table .= "<td>" . $emp['location'] . " " . $emp['municipality'] . " " . $emp['province'] . "</td>";
                }
            }
            else
            {
                $table .= "<tr>";
                $table .= "<td colspan='6' class='text-center'>No records found.</td>";
                $table .= "</tr>";
            }

            $table .= "</table>";
        }
        else if ($type == "supplierExcel")
        {
            $table .= "<table border=1>";
            $table .= "<tr>";
            $table .= "<th colspan='4'>List of Suppliers for " . date("F j, Y") . "</th>";
            $table .= "</tr>";
            $table .= "<tr>";
            $table .= "<th>Company Name</th>";
            $table .= "<th>City</th>";
            $table .= "<th>Province</th>";
            $table .= "<th>Phone Number</th>";
            $table .= "</tr>";

            $supplierDetails = $this->supplierDetails();

            if (count($supplierDetails) > 0)
            {
                foreach ($supplierDetails AS $supp)
                {
                    $table .= "<tr>";
                    $table .= "<td>" . $supp['companyName'] . "</td>";
                    $table .= "<td>" . $supp['city'] . "</td>";
                    $table .= "<td>" . $supp['province'] . "</td>";
                    $table .= "<td>'" . $supp['phoneNumber'] . "</td>";
                }
            }
            else
            {
                $table .= "<tr>";
                $table .= "<td colspan='4' class='text-center'>No records found.</td>";
                $table .= "</tr>";
            }
        }
        else if ($type == "productExcel")
        {
            $table .= "<table border=1>";
            $table .= "<tr>";
            $table .= "<th colspan='8'>List of Products for " . date("F j, Y") . "</th>";
            $table .= "</tr>";
            $table .= "<tr>";
            $table .= "<th>Product Code</th>";
            $table .= "<th>Product Name</th>";
            $table .= "<th>Product Description</th>";
            $table .= "<th>Quantity on Stock</th>";
            $table .= "<th>Quantity on Hand</th>";
            $table .= "<th>Product Price</th>";
            $table .= "<th>Category</th>";
            $table .= "<th>Supplier Name</th>";
            $table .= "</tr>";

            $productDetails = $this->productDB();

            if (count($productDetails) > 0)
            {
                foreach ($productDetails AS $products)
                {
                    $category = $this->categoryDB(1, array("id" => $products['category_id']));
                    $supplier = $this->supplierDetails(2, array("id" => $products['supplier_id']));

                    $table .= "<tr>";
                    $table .= "<td class='text-center'>" . $products['productCode'] . "</td>";
                    $table .= "<td class='text-center'>" . $products['productName'] . "</td>";
                    $table .= "<td class='text-center'>" . $products['productDescription'] . "</td>";
                    $table .= "<td class='text-center'>" . $products['qtyStock'] . "</td>";
                    $table .= "<td class='text-center'>" . $products['onHand'] . "</td>";
                    $table .= "<td class='text-center'>" . $products['price'] . "</td>";
                    $table .= "<td class='text-center'>" . $category[0]['categoryName'] . "</td>";
                    $table .= "<td class='text-center'>" . $supplier[0]['companyName'] . "</td>";
                    $table .= "</tr>";
                }
            }
            else
            {
                $table = "<tr><td colspan='8' class='text-center'>No Products Recorded</td></tr>";
            }
        }
        else if ($type == "inventoryExcel")
        {
            $table .= "<table border=1>";
            $table .= "<tr>";
            $table .= "<th colspan='6'>List of Inventory for " . date("F j, Y") . "</th>";
            $table .= "</tr>";
            $table .= "<tr>";
            $table .= "<th>Product Code</th>";
            $table .= "<th>Product Name</th>";
            $table .= "<th>Quantity on Stock</th>";
            $table .= "<th>Quantity on Hand</th>";
            $table .= "<th>Category</th>";
            $table .= "<th>Date Stock In</th>";
            $table .= "</tr>";

            $productDetails = $this->productDB();

            if (count($productDetails) > 0)
            {
                foreach ($productDetails AS $products)
                {
                    $category = $this->categoryDB(1, array("id" => $products['category_id']));

                    $table .= "<tr>";
                    $table .= "<td class='text-center'>" . $products['productCode'] . "</td>";
                    $table .= "<td class='text-center'>" . $products['productName'] . "</td>";
                    $table .= "<td class='text-center'>" . $products['qtyStock'] . "</td>";
                    $table .= "<td class='text-center'>" . $products['onHand'] . "</td>";
                    $table .= "<td class='text-center'>" . $category[0]['categoryName'] . "</td>";
                    $table .= "<td class='text-center'>" . date("F j, Y g:i A", strtotime($products['date_stock_in'])) . "</td>";
                    $table .= "</tr>";
                }
            }
            else
            {
                $table = "<tr><td colspan='6' class='text-center'>No Inventory Recorded</td></tr>";
            }
        }
        else if ($type == "transactionExcel")
        {

        }

        return $table;
    }

    public function insertEmployee($data)
    {
        return $this->employeeDetails("", 2, $data);
    }

    public function employeeModal($id)
    {
        $emp = $this->employeeDetails($id);
        $firstName = $emp[0]['firstName'];
        $middleName = $emp[0]['middleName'];
        $lastName = $emp[0]['lastName'];
        $gender = $emp[0]['gender'];
        $emailAddress = $emp[0]['emailAddress'];
        $phoneNumber = $emp[0]['phoneNumber'];
        $hiredDate = $emp[0]['hiredDate'];
        $location = $emp[0]['location'];
        $province = $emp[0]['province'];
        $municipality = $emp[0]['municipality'];
        $position = $emp[0]['positionId'];

        return json_encode(
            [
                'firstName' => $firstName,
                'middleName' => $middleName,
                'lastName' => $lastName,
                'gender' => $gender,
                'email' => $emailAddress,
                'phonenumber' => $phoneNumber,
                'position' => $position,
                'fromdate' => $hiredDate,
                'address' => $location,
                'province' => $province,
                'city' => $municipality,
            ]
        );
    }

    public function updateEmployee($data)
    {
        return $this->employeeDetails("", 3, $data);
    }

    public function employeeCount()
    {
        return $this->employeeDetails("", 4);
    }

    public function customerCount()
    {
        return $this->customerDetails(3);
    }

    public function userCount()
    {
        return $this->loginUser([], 2);
    }

    public function userSettings($id, $randomId)
    {
        $empDetails = $this->employeeDetails($id);
        $userDetails = $this->loginUser(array("randomId" => $randomId), 1);

        $firstName = $empDetails[0]['firstName'];
        $middleName = $empDetails[0]['middleName'];
        $lastName = $empDetails[0]['lastName'];
        $gender = $empDetails[0]['gender'];
        $emailAddress = $empDetails[0]['emailAddress'];
        $phoneNumber = $empDetails[0]['phoneNumber'];
        $hiredDate = $empDetails[0]['hiredDate'];
        $location = $empDetails[0]['location'];
        $province = $empDetails[0]['province'];
        $municipality = $empDetails[0]['municipality'];

        $userName = $userDetails[0]['userName'];
        $password = $userDetails[0]['password'];

        return [$firstName, $lastName, $gender, $emailAddress, $phoneNumber, $hiredDate, $location, $province, $municipality, $userName, $password, $middleName];
    }

    public function updateSettings($data, $userData)
    {
        $this->employeeDetails("", 5, $data);
        $this->loginUser($userData, 3);
        
        return true;
    }

    public function getAccessType()
    {
        return $this->accessFields("", 1);
    }

    public function getUserNoAccounts()
    {
        return $this->employeeDetails("", 6, []);
    }

    public function addUser($data)
    {
        return $this->userTable(1, $data);
    }

    public function editUserModal($id)
    {
        $empDetails = $this->employeeDetails($id);
        $userDetails = $this->loginUser(array("userId" => $id), 4);

        $fullName = $empDetails[0]['firstName'] . " " . $empDetails[0]['middleName'] . " " . $empDetails[0]['lastName'];
        $userName = $userDetails[0]['userName'];
        $password = $userDetails[0]['password'];
        $typeId = $userDetails[0]['typeId'];

        $accessField = $this->accessFields($typeId);
        $type = $accessField[0]['type'];

        return json_encode(
            [
                'fullName' => $fullName,
                'username' => $userName,
                'password' => $password,
                'type' => $type,
                'id' => $id,
            ]
        );
    }

    public function updateUser($data)
    {
        return $this->loginUser($data, 5);
    }

    public function deleteUser($id)
    {
        return $this->loginUser(array("id" => $id), 6);
    }

    public function addSupplier($data)
    {
        return $this->supplierDetails(1, $data);
    }

    public function supplierModal($id)
    {
        $supplierDetails = $this->supplierDetails(2, array("id" => $id));

        $companyName = $supplierDetails[0]['companyName'];
        $province = $supplierDetails[0]['province'];
        $supplierId = $supplierDetails[0]['supplier_id'];
        $city = $supplierDetails[0]['city'];
        $phoneNumber = $supplierDetails[0]['phoneNumber'];

        return json_encode(
            [
                'companyName' => $companyName,
                'province' => $province,
                'supplierId' => $supplierId,
                'city' => $city,
                'companyPhone' => $phoneNumber,
                'id' => $id,
            ]
        );
    }

    public function updateSupplier($data)
    {
        return $this->supplierDetails(3, $data);
    }

    public function deleteSupplier($id)
    {
        return $this->supplierDetails(5, array("id" => $id));
    }

    public function supplierCount()
    {
        return $this->supplierDetails(4);
    }

    public function getCategory()
    {
        $productCode = $this->randomString();
        $category = $this->categoryDB();
        $supplier = $this->supplierDetails();

        return [$productCode, $category, $supplier];
    }

    public function productTable()
    {
        $table = "";

        $productDetails = $this->productDB();

        if (count($productDetails) > 0)
        {
            foreach ($productDetails AS $products)
            {
                $category = $this->categoryDB(1, array("id" => $products['category_id']));
                $supplier = $this->supplierDetails(2, array("id" => $products['supplier_id']));

                $table .= "<tr>";
                $table .= "<td class='text-center'>" . $products['productCode'] . "</td>";
                $table .= "<td class='text-center'>" . $products['productName'] . "</td>";
                $table .= "<td class='text-center'>" . $products['productDescription'] . "</td>";
                $table .= "<td class='text-center'>" . $products['qtyStock'] . "</td>";
                $table .= "<td class='text-center'>" . $products['onHand'] . "</td>";
                $table .= "<td class='text-center'>" . $products['price'] . "</td>";
                $table .= "<td class='text-center'>" . $category[0]['categoryName'] . "</td>";
                $table .= "<td class='text-center'>" . $supplier[0]['companyName'] . "</td>";
                $table .= "<td class='text-center'>
                            <a href='#' data-toggle='modal' data-target='#editProductModal' data-id='" . $products['product_id'] . "' type='button' class='btn btn-primary bg-gradient-primary editSupplier' style='border-radius: 0px;'><i class='fas fa-fw fa-edit'></i></a>
                            <a href='#' onclick='deleteProduct($products[product_id])' type='button' class='btn btn-danger bg-gradient-danger deleteProduct' style='border-radius: 0px;'><i class='fas fa-fw fa-trash'></i></a>
                        </td>";
                $table .= "</tr>";
            }
        }
        else
        {
            $table = "<tr><td colspan='9' class='text-center'>No Products Recorded</td></tr>";
        }

        return $table;
    }

    public function addCategory($data)
    {
        return $this->categoryDB(2, $data);
    }

    public function changeCategoryStatus($data)
    {
        return $this->categoryDB(3, $data);
    }

    public function deleteCategory($id)
    {
        return $this->categoryDB(4, array("id" => $id));
    }

    public function addProduct($data)
    {
        return $this->productDB(2, $data);
    }

    public function deleteProduct($id)
    {
        return $this->productDB(4, array("id" => $id));
    }

    public function productCount()
    {
        return $this->productDB(5);
    }

    public function recentProducts()
    {
        $list = "";
        $productDetails = $this->productDB(3);

        if (count($productDetails) > 0)
        {
            foreach ($productDetails AS $product)
            {
                $list .= "<a href='#' class='list-group-item text-gray-800'>
                            <i class='fa fa-tasks fa-fw'></i> $product[productCode] - $product[productName]
                        </a>";
            }
        }

        return $list;
    }

    public function categoryTable()
    {
        $table = "";
        $categories = $this->categoryDB();

        $count = 0;
        if (count($categories) > 0)
        {
            foreach ($categories AS $category)
            {
                $count++;
                $status = ($category['status'] == 1) ? "Active" : "Inactive";
                $table .= "<tr>";
                $table .= "<td class='text-center'>$count</td>";
                $table .= "<td class='text-center'>$category[categoryName]</td>";
                $table .= "<td class='text-center'>$status</td>";
                $table .= "<td class='text-center'>
                            <button type='button' class='btn btn-primary bg-gradient-primary' style='border-radius: 0px;' data-id='$category[id]' id='changeStatus'>$status</button>
                            <a href='#' onclick='deleteCategory($category[id])' type='button' class='btn btn-danger bg-gradient-danger deleteCategory' style='border-radius: 0px;'><i class='fas fa-fw fa-trash'></i></a>
                        </td>";
                $table .= "</tr>";
            }
        }
        else
        {
            $table = "<tr><td colspan='4' class='text-center'>No Categories Recorded</td></tr>";
        }

        return $table;
    }

    public function inventoryTable()
    {
        $table = "";

        $productDetails = $this->productDB();

        if (count($productDetails) > 0)
        {
            foreach ($productDetails AS $products)
            {
                $category = $this->categoryDB(1, array("id" => $products['category_id']));

                $table .= "<tr>";
                $table .= "<td class='text-center'>" . $products['productCode'] . "</td>";
                $table .= "<td class='text-center'>" . $products['productName'] . "</td>";
                $table .= "<td class='text-center'>" . $products['qtyStock'] . "</td>";
                $table .= "<td class='text-center'>" . $products['onHand'] . "</td>";
                $table .= "<td class='text-center'>" . $category[0]['categoryName'] . "</td>";
                $table .= "<td class='text-center'>" . date("F j, Y g:i A", strtotime($products['date_stock_in'])) . "</td>";
                $table .= "</tr>";
            }
        }
        else
        {
            $table = "<tr><td colspan='7' class='text-center'>No Inventory Recorded</td></tr>";
        }

        return $table;
    }

    public function transactionTable()
    {
        $table = "";

        $transaction = $this->transactionDB();

        if (count($transaction) > 0)
        {
            foreach ($transaction AS $transact)
            {
                $id = $transact['id'];
                $customerId = $transact['customerId'];
                $customer = $this->customerDetails(0, array("id" => $customerId));
                $customerName = $customer[0]['firstName'] . " " . $customer[0]['lastName'];
                $transactionCount = $this->transactionDB(3, array("id" => $id));

                $table .= "<tr>";
                $table .= "<td class='text-center'>" . $transact['transactionNumber'] . "</td>";
                $table .= "<td class='text-center'>" . $customerName . "</td>";
                $table .= "<td class='text-center'>" . $transactionCount . "</td>";
                $table .= "<td class='text-center'>" . date("F j, Y g:i A", strtotime($transact['transactionDate'])) . "</td>";
                $table .= "<td class='text-center'>
                            <a href='#' data-toggle='modal' data-target='#viewTransactionDetails' data-id='" . $id . "' type='button' class='btn btn-primary bg-gradient-primary viewTransaction' style='border-radius: 0px;'><i class='fas fa-fw fa-eye'></i></a>
                        </td>";
                $table .= "</tr>";
            }
        }
        else
        {
            $table = "<tr><td colspan='5' class='text-center'>No Transactions Recorded</td></tr>";
        }

        return $table;
    }

    public function transactionCount()
    {
        return $this->transactionDB(2);
    }
}