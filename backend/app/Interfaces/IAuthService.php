<?php

namespace App\Interfaces;

interface IAuthService
{
    public function Register($fields);
    public function Login($fields);
}
