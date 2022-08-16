<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreCommentRequest;
use App\Http\Resources\Admin\CommentResource;
use App\Models\Comment;
use App\Models\Recipe;
use Inertia\Inertia;

class CommentController extends Controller
{
    public function index()
    {
        $this->authorize('viewAny', Comment::class);

//        $comments = CommentResource::collection(Comment::all());
//
//        return inertia('Admin/Comments/Index', compact('comments'));

        return Inertia::render('Admin/Comments/Index', [
           'comments' =>  Comment::query()
               ->orderBy('id', 'desc')
               ->paginate(20)
               ->through(function($comment) {
                   return [
                       'id' => $comment->id,
                       'comment' => $comment->comment,
                       'created_at' => $comment->created_at->format('Y-m-d'),
                       'user_name' =>$comment->user
                   ];
               })

        ]);
    }

    public function edit(Comment $comment)
    {
        $this->authorize('view', $comment);
//        $this->authorize('viewAny', Comment::class);
        return inertia('Admin/Comments/Edit', compact('comment'));
    }

    public function update(Comment $comment, StoreCommentRequest $request)
    {
        $this->authorize('update', $comment);
        $comment->update($request->validated());

        return redirect()->route('admin.comments.index')
            ->with('message', 'Comment updated successfully');
    }

    public function destroy(Comment $comment)
    {
        $this->authorize('delete', $comment);

     $comment->delete();

     return redirect()->route('admin.comments.index')
         ->with('message', 'Comment deleted successfully');
    }
}
