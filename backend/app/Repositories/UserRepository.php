<?php

namespace App\Repositories;


use App\Models\User;
use App\Models\UserDetails;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class UserRepository implements IUserRepository
{
    /**
     * @throws Exception
     */
    public function CreateUser($fields): User
    {
        try {
            \DB::beginTransaction();

            $fields['password'] = bcrypt($fields['password']);
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

    public function GetUsers()
    {
        return User::select('id', 'name', 'email')->with('UserDetails')->get();
    }

    public function AddUser($fields)
    {
        try {
            DB::beginTransaction();

            $user = User::create($fields);
            $user->UserDetails()->create($fields);

            DB::commit();
        } catch (Exception $exception) {
            DB::rollBack();

            Log::error('Add user error: ' . $exception->getMessage());
            return false;
        }
        return true;
    }

    public function UpdateUser($fields)
    {
        try {
            DB::beginTransaction();

            $user = User::find($fields['userId']);
            $user->fill($fields)->update();
            $user->UserDetails->fill($fields)->update();

            DB::commit();
        } catch (Exception $exception) {
            DB::rollBack();

            Log::error('Update user error: ' . $exception->getMessage());
            return false;
        }
        return true;
    }

    public function DeleteUser($userId)
    {
        try {
            DB::beginTransaction();

            User::find($userId)->UserDetails->delete();
            User::destroy($userId);

            DB::commit();
        } catch (Exception $exception) {
            DB::rollBack();

            Log::error('Delete user error: ' . $exception->getMessage());
            return false;
        }
        return true;
    }

}
