<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCommentRequest;
use App\Http\Resources\CommentResource;
use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function index()
    {
        $comments = CommentResource::collection(Comment::all());

        return inertia('Comments/Index', compact('comments'));
    }

    public function edit(Comment $comment)
    {
        return inertia('Comments/Edit', compact('comment'));
    }

    public function update(Comment $comment, StoreCommentRequest $request)
    {
        $comment->update($request->validated());

        return redirect()->route('comments.index')
            ->with('message', 'Comment updated successfully');
    }

    public function destroy(Comment $comment)
    {
     $comment->delete();

     return redirect()->route('comments.index')
         ->with('message', 'Comment deleted successfully');
    }
}
