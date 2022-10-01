<?php

namespace App\ValidationRules;

class RegisterRules
{
    public static function getRegisterRules(array $attributes) {
        return array(
            'name' => 'required|string',
            'email' => 'required|string|unique:users,email',
            'password' => 'required|string|confirmed'
        );
    }

    public static function getMessages(){
        return array(
            'name.required' => ''
        );
    }
}
