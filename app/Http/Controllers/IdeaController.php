<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\idea;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class IdeaController extends Controller
{
    public function store(){

        request()->validate([
            'content' => 'required|min:2|max:240'
        ]);

        $idea = new idea([
            'user_id' =>  Auth::user()->id,
            'content' => request()->get('content','')
        ]);
        $idea->save();

        return redirect()->route('dashboard')->with('success', 'Idea successfully created');

    }

    public function destroy(Idea $idea){
        if(!Gate::allows('idea.delete')){
            abort(403);
        }

        $idea->delete();

        if(request()->expectsJson()){
            return response()->json(
            [
                'message'=> 'Idea deleted successfully',
            ]);
        }

        return redirect()->route('dashboard')->with('success', 'Idea successfully deleted');

    }

    public function show(Idea $idea, Comment $comment){

        if(request()->expectsJson()){
            return response()->json(
            [
                'id'=> $idea->id,
                'content'=> $idea->content,
                'status code'=> 200,
            ]);
        }

        return view('ideas.show', compact('idea', 'comment'));
    }

    public function edit(Idea $idea){

        if(!Gate::allows('idea.edit', $idea)){
            abort(403);
        }


        $editing = true;
        return view('ideas.show',[
            'idea' => $idea,
        ], ['editing' => $editing]);
    }

    public function update(Idea $idea){

        if(!Gate::allows('idea.edit', $idea)){
            abort(403);
        }

        request()->validate([
            'content' => 'required|min:2|max:240'
        ]);

        $idea::create([
            'content' => request()->get('content','')
        ]);
        $idea->save();

        return redirect()->route('ideas.show', $idea->id)->with('success', 'Idea successfully updated');

    }
}
