<?php

namespace App\Repositories;

use App\Models\User;
use Exception;

class UserRepository implements IUserRepository
{
    /**
     * @throws Exception
     */
    public function CreateUser($fields): User
    {
        try {
            \DB::beginTransaction();

            $user = User::create($fields);

            \DB::commit();
        } catch (Exception $exception) {
            \DB::rollback();
            throw $exception;
        }

        return $user;
    }

    public function GetUserByEmail($email) {
        return User::where('email', $email)->first();
    }
}
