<?php

namespace App\Repositories;


use App\Models\Role;
use App\Models\User;
use Exception;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class UserRepository implements IUserRepository
{
    /**
     * @throws Exception
     */
    public function CreateUser(array $fields): bool
    {
        try {
            $fields['password'] = bcrypt($fields['password']);
            User::create($fields);
        } catch (Exception $exception) {
            Log::error('Add user error: ' . $exception->getMessage());
            return false;
        }
        return true;
    }

    public function GetUserByEmail(string $email): ?User
    {
        return User::where('email', $email)->first();
    }

    public function GetRoles()
    {
       return Role::select('id', 'name')->get();
    }

    public function GetUserById(int $userId): ?User
    {
        return User::select('id', 'email', 'first_name', 'last_name')
            ->with([
                'UserDetails' =>
                    fn($query) => $query->select('user_id' ,'identity_number', 'address', 'phone', 'occupation', 'birth_date'),
                'Roles'
            ])->find($userId);
    }

    public function SearchUsers(array $filters): ?LengthAwarePaginator
    {
        $query = User::select('id', 'first_name', 'last_name')
            ->whereDoesntHave('Roles', function ($query) {
                $query->where('name', 'admin');
            });

            if(isset($filters['name']) && $filters['name'] != ''){
                $query->where(function ($query) use ($filters) {
                    $query->where('first_name', 'like', '%'.$filters['name'].'%')
                        ->orWhere('last_name', 'like', '%'.$filters['name'].'%');
                });
            }

        $query->withCount([
            'Transaction' => fn($query) => $query->where('is_returned', false),
        ]);

        return $query->paginate($filters['pagination']['per_page'], null, null, $filters['pagination']['page']);
    }

    public function AddUser(array $fields): bool
    {
        try {
            DB::beginTransaction();

            $fields['password'] = bcrypt($fields['password']);
            $user = User::create($fields);
            $user->UserDetails()->create($fields);
            $user->Roles()->attach($fields['roles']);

            DB::commit();
        } catch (Exception $exception) {
            DB::rollBack();

            Log::error('Add user error: ' . $exception->getMessage());
            return false;
        }
        return true;
    }

    public function UpdateUser(array $fields): bool
    {
        try {
            DB::beginTransaction();

            if(isset($fields['password']))
                $fields['password'] = bcrypt($fields['password']);

            $user = User::find($fields['userId']);

            if(!$user)
                return false;
            $user->fill($fields)->update();
            $user->UserDetails->fill($fields)->update();
            $user->Roles()->sync($fields['roles']);

            DB::commit();
        } catch (Exception $exception) {
            DB::rollBack();

            Log::error('Update user error: ' . $exception->getMessage());
            return false;
        }
        return true;
    }

    public function DeleteUser(int $userId): bool
    {
        try {
            DB::beginTransaction();

            $user = User::find($userId);
            $user->UserDetails()->delete();
            $user->Roles()->detach();
            $user->delete();

            DB::commit();
        } catch (Exception $exception) {
            DB::rollBack();

            Log::error('Delete user error: ' . $exception->getMessage());
            return false;
        }
        return true;
    }

}
