<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\IssuedTicket;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $date = date('Y-m-d');

        $issued_tickets = IssuedTicket::with('user')->where('created_at', 'like', '%'.$date.'%')->where('issued_by', Auth()->user()->id )->orderBy('created_at', 'desc')->paginate(15);

        return view('home', compact('issued_tickets'));
        
    }
}
