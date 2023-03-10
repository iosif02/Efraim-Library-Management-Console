<?php

namespace App\Repositories;


use App\Models\User;
use Exception;
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

    public function GetUsers(array $filters): ?LengthAwarePaginator
    {
        $query = User::select('id', 'name')
            ->with([
                'UserDetails' => fn($query) => $query->select('id', 'user_id', 'first_name', 'last_name')
            ])
            ->whereHas('UserDetails', function ($query) use ($filters) {
                if(isset($filters['name']) && $filters['name'] != '') {
                    $query->where('first_name', 'like', '%'.$filters['name'].'%')
                        ->orwhere('last_name', 'like', '%'.$filters['name'].'%');
                }
            })
            ->withCount([
                'Transaction' => fn($query) => $query->where('is_returned', false),
            ]);

        return $query->paginate($filters['pagination']['per_page'], null, null, $filters['pagination']['page']);
    }

    public function AddUser(array $fields): bool
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

    public function UpdateUser(array $fields): bool
    {
        try {
            DB::beginTransaction();
            $user = User::find($fields['userId']);
            if(!$user)
                return false;
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

    public function DeleteUser(int $userId): bool
    {
        try {
            DB::beginTransaction();

            $user = User::find($userId);
            $user->UserDetails()->delete();
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
