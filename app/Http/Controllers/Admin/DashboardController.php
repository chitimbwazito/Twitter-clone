<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class DashboardController extends Controller
{
    public function index(){
        $users = User::get();

        return view('admin.dashboard', compact('users'));
    }
    public function edit(User $user){
        return view('admin.users-edit', compact('user'));
    }

    public function show(User $user){
        return view('admin.users-show', compact('user'));
    }
    public function update(Request $request, User $user){
        $validated = $request->validate([
            'name' =>'min:2|max:10',
            'email' =>'email|unique:users,email,',
        ]);
        $user->update($validated);

        return redirect()->route('admin.dashboard')->with('success', 'User updated successfully');

    }
    public function destroy(User $user){
        $user->delete();

        return redirect()->route('admin.dashboard')->with('success', 'User deleted successfully');
    }
}
