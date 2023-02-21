<?php

namespace App\Repositories;

interface IUserRepository
{
    public function CreateUser($fields);
    public function GetUserByEmail($email);
    public function GetUsers();
    public function AddUser($fields);
    public function UpdateUser($fields);
    public function DeleteUser($userId);
}
