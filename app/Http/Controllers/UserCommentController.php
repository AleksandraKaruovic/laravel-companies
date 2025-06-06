<?php

namespace App\Http\Controllers;

use App\Models\UserComment;
use Illuminate\Http\Request;

class UserCommentController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'company_id' => 'required|exists:companies,id',
            'comment' => 'required|string|max:1000',
        ]);

        UserComment::create([
            'user_id' => auth()->id(),
            'company_id' => $request->company_id,
            'comment' => $request->comment,
        ]);

        return back()->with('success', 'Comment posted successfully.');
    }

    public function update(Request $request, $id)
    {
    $comment = UserComment::findOrFail($id);

    if ($comment->user_id !== auth()->id()) {
        abort(403, 'Unauthorized');
    }

    $validated = $request->validate([
        'comment' => 'required|string|max:1000',
    ]);

    $comment->update(['comment' => $validated['comment']]);

    return redirect()->back();
    }

    public function destroy($id)
    {
    $comment = UserComment::findOrFail($id);

    if ($comment->user_id !== auth()->id()) {
        abort(403, 'Unauthorized');
    }

    $comment->delete();

    return redirect()->back();
    }

    public function restore($id)
    {
    $comment = UserComment::onlyTrashed()->findOrFail($id);

    if ($comment->user_id !== auth()->id()) {
        abort(403, 'Unauthorized');
    }

    $comment->restore();

    return redirect()->back()->with('success', 'Comment restored.');
    }

}
