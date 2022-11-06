<?php

namespace App\Repositories;

interface IUserRepository
{
    public function CreateUser($fields);
    public function GetUserByEmail($email);
}
