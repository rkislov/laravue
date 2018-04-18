<?php

namespace App\Http\Controllers\API;

use App\Ticket;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Laravelrus\LocalizedCarbon\LocalizedCarbon;

class TicketController extends Controller
{
    public function userTickets($id)
    {

        $tickets = Ticket::with('category')->where('user_id', $id)->get();
        return response()->json($tickets);
    }
    public function create()
    {
        Ticket::create([
            'title' => request('title'),
            'category_id' => request('category'),
            'priority' => request('priority'),
            'message' => request('message'),
            'user_id' => request('user_id'),
            'ticket_id' => date('Y').date('m').date('d').'.'.strtoupper(str_random(4)),
            'status'=>'Открыта',

        ]);

        return response()->json(['status'=>201]);
    }
    public function showTicket($id)
    {
        $ticket = Ticket::with('category')->with('comments')->findOrFail($id);
        $ticket->setAttribute('created',  LocalizedCarbon::instance($ticket->created_at)->diffForHumans());

        return response()->json($ticket);
    }
}
