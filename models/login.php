<?php

class Login extends Database
{
    public function authorizeUser($data)
    {
        if ($this->checkUserName($data) == FALSE)
        {
            return "0";
        }

        if ($this->checkPassword($data) == FALSE)
        {
            return "1";
        }

        $userData = $this->loginUser($data);

        if (count($userData) > 0)
        {
            return "success" . $userData[0]['randomId'];
        }
        else
        {
            return "2";
        }
    }
}