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

    public function positionName($posId) // Method for getting the position name
    {
        return $this->position($posId);
    }

    public function access() // method to get the user access
    {
        return $this->accessFields($this->typeId);
    }
}