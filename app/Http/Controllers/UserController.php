<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Gate;

class UserController extends Controller
{
    use AuthorizesRequests;

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {

        if (request()->expectsJson()) {
            return response()->json(
                [
                    'user id' => $user->id,
                    'username' => $user->name,
                ]
            );
        }
        $Ideas = $user->Ideas;
        return view('users.show', compact('user', 'Ideas'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        if (!Gate::allows('users.edit', $user)) {
            abort(403);
        }

        $Ideas = $user->Ideas;

        return view('users.edit', compact('user', 'Ideas'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        if (!Gate::allows('users.edit', $user)) {
            abort(403);
        }

        $validated = $request->validated();

        if ($request->has('image')) {
            $imagePath = $request->file('image')->store('profile', 'public');
            $validated['image'] = $imagePath;

            Storage::disk('public')->delete($user->image ?? '');
        }

        $user->update($validated);

        return redirect()->route('users.show', $user->id);
    }
}
