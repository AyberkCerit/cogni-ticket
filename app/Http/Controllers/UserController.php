<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index()
    {

        $users = User::paginate(10);
        return view('users_management', compact('users'));
    }

    public function destroy(User $user)
    {

        // Prevent self-deletion if desired, though optional
        if (Auth::id() === $user->id) {
            return redirect()->back()->with('error', 'You cannot delete your own admin account.');
        }

        $user->delete();

        return redirect()->back()->with('success', 'User successfully deleted.');
    }
}
