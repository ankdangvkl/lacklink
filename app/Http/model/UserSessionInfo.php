<?php

namespace App;

class UserSessionInfo
{
    private $username;
    private $password;
    private $role;

    public function __construct()
    {
    }

    public function setUsername($username)
    {
        $this->username = $username;
    }
    public function getUsername()
    {
        return $this->username;
    }

    public function setPassword($password)
    {
        $this->password;
    }
    public function getPassword()
    {
        return $this->password;
    }

    public function setRole($role)
    {
        $this->role;
    }
    public function getRole()
    {
        return $this->role;
    }

    public function __toString()
    {
        return '[username = ' . $this->username . ',password = ' . $this->password . ',role = ' . $this->role . ']';
    }
}
