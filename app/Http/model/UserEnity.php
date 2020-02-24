<?php

namespace App\Http\model;

class UserEntity {
    private $id;
    private $userName;
    private $password;
    private $dataUrl;
    private $active;
    private $roleName;

    public function __construct()
    {

    }

    public function setId($id) {
        $this->id = $id;
    }

    public function getId() {
        return $this->id;
    }

    public function setUserName($userName) {
        $this->userName = $userName;
    }

    public function getUserName() {
        return $this->userName;
    }

    public function setPassword($password) {
        $this->password = $password;
    }

    public function getPassword() {
        return $this->password;
    }

    public function setDataUrl($dataUrl) {
        $this->dataUrl = $dataUrl;
    }

    public function getDataUrl() {
        return $this->dataUrl;
    }

    public function setActive($active) {
        $this->active = $active;
    }

    public function getActive() {
        return $this->active;
    }

    public function setRoleName($roleName) {
        $this->roleName = $roleName;
    }

    public function getRoleName() {
        return $this->roleName;
    }
}
