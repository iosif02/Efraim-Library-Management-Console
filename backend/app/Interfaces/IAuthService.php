<?php

namespace App\Interfaces;

use App\Models\User;

interface IAuthService
{
    public function Register(array $fields): User;
    public function Login(array $fields): array;
}
