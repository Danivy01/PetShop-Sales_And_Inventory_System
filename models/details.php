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
}