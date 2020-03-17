<?php

namespace App\Http\common;

interface Repositories {

    public function add($table, $userInfo);

    public function getAll($table);

    public function getById($table, $id);

    public function getBy($table, $by);

    public function delete($table, $id);

    public function updateBy($table, $by);

}
