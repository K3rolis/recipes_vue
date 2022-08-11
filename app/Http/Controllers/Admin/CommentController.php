<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreCommentRequest;
use App\Http\Resources\Admin\CommentResource;
use App\Models\Comment;

class CommentController extends Controller
{
    public function index()
    {
        $comments = CommentResource::collection(Comment::all());

        return inertia('Admin/Comments/Index', compact('comments'));
    }

    public function edit(Comment $comment)
    {
        return inertia('Admin/Comments/Edit', compact('comment'));
    }

    public function update(Comment $comment, StoreCommentRequest $request)
    {
        $comment->update($request->validated());

        return redirect()->route('admin.comments.index')
            ->with('message', 'Comment updated successfully');
    }

    public function destroy(Comment $comment)
    {
     $comment->delete();

     return redirect()->route('admin.comments.index')
         ->with('message', 'Comment deleted successfully');
    }
}
