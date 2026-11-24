<?php

namespace App\Repositories;

use App\Models\User;
use App\Interfaces\UserRepositoryInterface;

class UserRepository implements UserRepositoryInterface
{
    public function getAll()
    {
        return User::all();
    }

    public function getById(string $id)
    {
        return User::findOrFail($id);
    }

    public function getByRole(string $role)
    {
        return User::where('role', $role)->get();
    }

    public function create(array $data)
    {
        return User::create($data);
    }

    public function update(array $data, string $id)
    {
        $user = User::findOrFail($id);
        $user->update($data);
        return $user;
    }

    public function delete($id)
    {
        return User::findOrFail($id)->delete();
    }

    public function updateStatus($status, $id)
    {
        return User::where('id', $id)->update(['status' => $status]);
    }

    public function updateRole($role, $id)
    {
        return User::where('id', $id)->update(['role' => $role]);
    }
}
