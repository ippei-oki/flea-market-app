<?php

namespace App\Http\Controllers;

use App\Http\Requests\CommentRequest;
use App\Models\Comment;
use Illuminate\Http\RedirectResponse;

class CommentController extends Controller
{
    public function store(CommentRequest $request, $item_id): RedirectResponse
    {
        Comment::create([
            'user_id' => auth()->id(),
            'item_id' => $item_id,
            'comment' => $request->input('comment'),
        ]);

        return redirect()->route('item.detail', ['item_id' => $item_id])
                         ->with('success', 'コメントが追加されました。');
    }
}