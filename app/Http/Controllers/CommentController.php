<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\idea;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class CommentController extends Controller
{
    public function store(Request $request, idea $Idea){

        // $validated = $request->validate([
        //     'content' =>'required|min:1' // validate the content field to be at least 5 characters long and required.
        // ]);

        $comment = new Comment([
            'idea_id' => $Idea->id,
            'user_id' => Auth::user()->id,
            'content' => $request->content,
        ]);

        $comment->save();

        return redirect()->route('ideas.show', $Idea->id)->with('success', 'Comment successfully added');
    }
    public function edit(Idea $Idea, Comment $comment){

        return view('ideas.comment-edit',[
            'idea' => $Idea,
        ], ['comment' => $comment]);
    }

    public function update(Idea $idea, Comment $comment){

        request()->validate([
            'content' => 'required|min:2|max:240'
        ]);

        $comment->update([
            'idea_id' => $idea->id,
            'user_id' => Auth::user()->id,
            'content' => request()->get('content','')
        ]);
        $comment->save();

        return redirect()->route('ideas.show', $idea->id)->with('success', 'Comment successfully updated');

    }
    public function destroy(Idea $idea, Comment $comment){

        $comment->delete();

        if(request()->expectsJson()){
            return response()->json(
            [
                'message'=> 'Comment deleted successfully',
            ]);
        }

        return redirect()->route('ideas.show', $idea->id)->with('success', 'Comment successfully deleted');

    }
 }
