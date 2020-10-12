<?php

namespace App\Http\Controllers;

use App\IssuedTicket;
use App\OrganizationInfo;
use App\Ticket;
use App\TicketSetup;
use Illuminate\Http\Request;


class ReportController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('check_user_perm');
    }

    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        if( !is_null($request->get('date')) ){

            $date = $request->get('date');

            $issued_tickets = IssuedTicket::with('ticket')->where('created_at', 'like', '%'.date('Y-m-d', strtotime($date)).'%')->orderBy('created_at', 'desc')->get();

            $total_count = IssuedTicket::where('created_at', 'like', '%'.date('Y-m-d', strtotime($date)).'%')->pluck('total');
            $total_amount  = array_sum($total_count->toArray());

        }else{

            $date = date('Y-m-d');

            $issued_tickets = IssuedTicket::with('ticket')->where('created_at', 'like', '%'.$date.'%')->orderBy('created_at', 'desc')->get();

            $total_count = IssuedTicket::where('created_at', 'like', '%'.$date.'%')->pluck('total');
            $total_amount  = array_sum($total_count->toArray());

        }

        $tickets = Ticket::all();

        return view('report.index')->with(['date' => $date ,'total_amount' => $total_amount, 'total_count' => $total_count, 'issued_tickets' => $issued_tickets, 'tickets' => $tickets]);
    }

    /**
     * Print a specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function print($date)
    {

        if( Auth()->user()->hasPermission('print-reports') ){

            $tickets = Ticket::all();

            $total_issued_ticket = IssuedTicket::where('created_at', 'like', '%'.date('Y-m-d', strtotime($date)).'%')->pluck('total');

            $total_amount  = array_sum($total_issued_ticket->toArray());

            $org_info = OrganizationInfo::get()->first();

            return view('report.print')->with(['date' => $date, 'tickets' => $tickets, 'total_amount' => $total_amount, 'org_info' => $org_info]);
        }

        return redirect()->route('home');

    }


}
