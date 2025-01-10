<?php

namespace App\Http\Controllers;

use App\Models\idea;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FeedController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(){

        $FollowingIDs = Auth::user()->following()->pluck('user_id');

        $ideas = idea::whereIn('user_id', $FollowingIDs)->latest();

        if (request()->has('search')) {
            $ideas = $ideas->where('content', 'like', '%' . request()->get('search', '') . '%');
        }

        return view('dashboard', ['ideas' => $ideas->paginate(5)]);
    }
}
