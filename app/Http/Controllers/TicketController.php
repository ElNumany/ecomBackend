<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use Illuminate\Http\Request;
use PhpParser\Node\Stmt\Return_;
use Illuminate\Pagination\Paginator;

Paginator::useBootstrap();
class TicketController extends Controller
{
    public function index(){
    $tickets = Ticket::with(['ticketType'  , 'customer' ,  'order'])->paginate(env('PAGINATION_COUNT'));
    // return $tickets;
    return view('Admin.Tickets.tickets')->with(
    [ 'tickets' => $tickets,]
    );
}
}
