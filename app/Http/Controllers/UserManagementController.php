<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;
use App\Services\UserService;

class UserManagementController extends Controller
{
    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function index()
    {
        $users = $this->userService->getUsers();
        return Inertia::render('Users', ['users' => $users]);
    }


    public function destroy($id)
    {
        $this->userService->deleteUser($id);

        $users = $this->userService->getUsers();
        return Inertia::render('Users', ['users' => $users]);
    }

}
