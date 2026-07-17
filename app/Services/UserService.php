<?php

namespace App\Services;

use App\Models\User;

class UserService
{
    public function createUser(array $data)
    {
        return User::create($data);
    }

    public function getUsers()
    {
        return User::with('role')->get();
    }

    public function getUserById($id)
    {
        return User::findOrFail($id);
    }

    public function getUsersByRole($roleId)
    {
        return User::where('role_id', $roleId)->get();
    }

    public function setUserRole($userId, $roleId)
    {
        $user = User::findOrFail($userId);
        $user->role_id = $roleId;
        $user->save();
    }

    public function updateUser($id, array $data)
    {
        $user = User::findOrFail($id);
        $user->update($data);
    }

    public function deleteUser($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
    }

}