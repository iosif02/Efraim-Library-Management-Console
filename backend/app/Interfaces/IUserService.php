<?php

namespace App\Interfaces;

interface IUserService
{
    public function GetUsers();
    public function AddUser($fields);
    public function UpdateUser($fields);
    public function DeleteUser($userId);
}
