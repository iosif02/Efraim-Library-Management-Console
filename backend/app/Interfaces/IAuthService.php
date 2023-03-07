<?php

namespace App\Interfaces;

interface IAuthService
{
    public function Register(array $fields): bool;
    public function Login(array $fields): ?array;
}
