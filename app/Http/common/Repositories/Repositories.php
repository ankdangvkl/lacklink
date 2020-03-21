<?php

namespace App\Http\common;

interface Repositories {

    public function add($table, $userInfo);

    public function getAll($table);

    public function getById($table, $id);

    public function getByUserAccount($table, $name);

    public function getByUserName($table, $username);

    public function delete($table, $id);

}
