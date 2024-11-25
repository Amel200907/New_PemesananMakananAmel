<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CommentController extends Controller
{
    //
    public function store(Request $request, $menuId)
    {
        $request->validate([
            'comment' => 'required',
        ]);

        Comment::create([
            'user_id' => auth()->id(),
            'menu_id' => $menuId,
            'comment' => $request->comment,
        ]);

        return redirect()->route('menu.show', $menuId)->with('success', 'Comment added successfully.');
    }

    public function destroy($id)
    {
        $comment = Comment::findOrFail($id);
        $comment->delete();

        return back()->with('success', 'Comment deleted successfully.');
    }
}
