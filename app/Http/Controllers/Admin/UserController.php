<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        return view('admin.users.index');
    }

    public function data()
    {
        $users = User::orderBy('created_at', 'DESC')->get();
        return datatables()->of($users)
            ->addColumn('email_verified_at', function (User $user) {
                if ($user->email_verified_at == null) {
                    return 'User has not verified email yet';
                }
                return $user->email_verified_at->diffForHumans();
            })
            ->addColumn('created_at', function (User $user) {
                return $user->created_at->diffForHumans();
            })
            ->addIndexColumn()
            ->toJson();
    }
}
