<?php

namespace App\Http\common;

interface Repositories {

    function add($table, $userInfo);

    function delete($table, $id);

    function updateBy($table, $by);

    function getAll($table);

    function getById($table, $id);

    function getByUserNameAndPassword($table, $userName, $password);

    function getBy($table, $by);
}
