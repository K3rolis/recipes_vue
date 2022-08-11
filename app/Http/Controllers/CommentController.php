<?php

namespace App\Http\Controllers;

use App\Http\Requests\Admin\StoreCommentRequest;
use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(StoreCommentRequest $request)
    {
//        Comment::create($request->validated());
        Comment::create($request->validated());

        return redirect()->back()->with('message', 'Comment added successfully!');
    }

    public function edit(Comment $comment)
    {
        return inertia('Comments/Edit', compact('comment'));
    }

    public function update(Comment $comment, StoreCommentRequest $request)
    {
        $comment->update($request->validated());

        return redirect()->route('recipe.show', $comment->recipe_id)->with('message', 'Comment edited successfully');

    }

    public function destroy(Comment $comment)
    {
        $comment->delete();

        return redirect()->route('recipe.show', $comment->recipe_id)
            ->with('message', 'Comment deleted successfully');
    }

}
