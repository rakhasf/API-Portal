<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use App\Http\Resources\CommentResource;

class CommentController extends Controller
{
    public function store(Request $request)
    {
        $request -> validate([
            'post_id' => 'required|exists:posts,id',
            'comments_content' => 'required',
        ]);

        $request['user_id'] = auth()->user()->id;

        $comment = Comment::create($request->all());

        // return response()->json($comment);

        return new CommentResource($comment->loadMissing(['commentator:id,name']));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'comments_content' => 'required'
        ]);

        $comment = Comment::findOrFail($id);
        $comment->update($request->only('comment_section'));
        
        return new CommentResource($comment->loadMissing(['commentator:id,name']));
    }
}
