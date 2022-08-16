<?php

namespace App\Http\Controllers;

use App\Http\Requests\Admin\StoreCommentRequest;
use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(StoreCommentRequest $request)
    {
        $this->authorize('create', Comment::class);
//        Comment::create($request->validated());
        Comment::create($request->validated());

        return redirect()->back()->with('message', 'Comment added successfully!');
    }

    public function edit(Comment $comment)
    {
        $this->authorize('view', $comment);
        return inertia('Comments/Edit', compact('comment'));
    }

    public function update(Comment $comment, StoreCommentRequest $request)
    {
        $this->authorize('update', $comment);
        $comment->update($request->validated());

        return redirect()->route('recipe.show', $comment->recipe_id)->with('message', 'Comment edited successfully');

    }

    public function destroy(Comment $comment)
    {
        $this->authorize('delete', $comment);

        $comment->delete();

        return redirect()->route('recipe.show', $comment->recipe_id)
            ->with('message', 'Comment deleted successfully');
    }

}
