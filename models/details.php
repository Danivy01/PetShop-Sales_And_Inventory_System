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
            $table .= "<td class='text-center'><a href='#' data-toggle='modal' data-id='" . $emp['id'] . "' data-target='#employeeModal' type='button' class='btn btn-primary bg-gradient-primary' style='border-radius: 0px;'><i class='fas fa-fw fa-edit'></i></a></td>";
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
}