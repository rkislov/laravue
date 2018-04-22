<?php

namespace App\Http\Controllers\API;

use App\Comment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CommentController extends Controller
{
    public function create()
    {
        Comment::create([

            'comment' => request('comment'),
            'ticket_id' => request('ticket_id'),
            'user_id' => request('user_id'),

        ]);

        return response()->json(['status'=>201]);
    }

    public function ticketComments($id)
    {
        $comments = Comment::with('user')->where('ticket_id', $id)->get();

        return  response()->json($comments);
    }
}
