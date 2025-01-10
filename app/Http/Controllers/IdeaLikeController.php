<?php

namespace App\Http\Controllers;

use App\Models\idea;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IdeaLikeController extends Controller
{
    public function like(idea $idea){
        $user_id = Auth::user()->id;
        $idea->likes()->attach($user_id);

        return redirect()->route('dashboard');
    }
    public function unlike(idea $idea){
        $user_id = Auth::user()->id;
        $idea->likes()->detach($user_id);

        return redirect()->route('dashboard');
    }

}
