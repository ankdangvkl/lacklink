<?php

namespace App\Http\model;

class UserEntity {
    private $id;
    private $username;
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

    public function setusername($username) {
        $this->username = $username;
    }

    public function getusername() {
        return $this->username;
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
