<?php

namespace App\Http\Controllers;

use App\IssuedTicket;
use App\OrganizationInfo;
use App\Ticket;
use App\TicketSetup;
use Illuminate\Http\Request;

class IssuedTicketController extends Controller
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
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $this->validate($request, [
            'ticket_id' => 'required',
            'ticket_type' => 'required',
            ]);

    
        $uniqid = 1; 
        // Check if Ticket exist for the Current Day
        $last_id = IssuedTicket::where('created_at', 'like', '%'.date('Y-m-d').'%')->latest()->first(); 
        // if Ticket Exist Auto-Increment "Ticket_Num"
        if( $last_id != null  ){
            $uniqid = $uniqid + $last_id->ticket_num;
        }

        try {
            // get Cost by Ticket_id And Setup_type
            list($adult_ticket) = TicketSetup::where(['ticket_id' => $request['ticket_id'], 'setup_type' => 'adult'])->limit(1)->get()->toArray();  // convert DB Object to an Array
            list($children_ticket) = TicketSetup::where(['ticket_id' => $request['ticket_id'], 'setup_type' => 'children'])->limit(1)->get()->toArray();  // convert DB Object to an Array
        }catch(\ErrorException $e){

            return redirect()->back()->with('error', "Please Set Up Ticket Price");

        }

        if( $request['ticket_type'] == 'family' ){


            $adult_total = $adult_ticket['cost'] * $request['no_of_adult'];

            $children_total = $children_ticket['cost'] * $request['no_of_children'];

            $ticket_total = $children_total + $adult_total; 


        }elseif( $request['ticket_type'] == 'group' ){

            $request['no_of_adult'] = $request['no_of_persons'];

            $request['no_of_children'] = null;

            $ticket_total = $request['rate'] * $request['no_of_persons'];

        }else{

            if( is_null($request['no_of_adult']) && is_null($request['no_of_children']) ){

                return redirect()->back()->with('error', 'Unable to Add Ticket');

            } 

            $adult_total = $adult_ticket['cost'] * $request['no_of_adult'];

            $children_total = $children_ticket['cost'] * $request['no_of_children'];

            $ticket_total = $children_total + $adult_total; 

        }


    
        $ticket = new IssuedTicket();

        $ticket->ticket_num = $uniqid;
        $ticket->ticket_id = $request['ticket_id'];
        $ticket->no_of_adult = $request['no_of_adult'] ? $request['no_of_adult'] : 0;
        $ticket->no_of_children = $request['no_of_children'] ? $request['no_of_children'] : 0 ;
        $ticket->ticket_type = $request['ticket_type'];
        $ticket->total = $ticket_total;
        $ticket->issued_by = Auth()->user()->id;
        $ticket->save();

        return redirect()->route('issued-ticket.print', $ticket->id);

    }

    /**
     * Display Ticket Type 
     * and it's Components Fields.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        //
        $query = 'normal';

        if( !is_null($request->get('ticket_type')) ){
            $query = $request->get('ticket_type');
        }

        $ticket = Ticket::where('slug', $id)->get()->first();

        $id = $ticket->id;

        return view('ticket.issue_ticket', compact('ticket', 'query', 'id'));
    }


    /**
     * Print a specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function print($id)
    {
        //if( Auth()->user()->hasPermission('reprint-ticket') ){

            $ticket = IssuedTicket::with("user")->where('id', $id)->get()[0];

            $org_info = OrganizationInfo::get()->first();

            return view('ticket/print')->with(['ticket' => $ticket, 'org_info' => $org_info]);
        //}

        //return redirect()->route('home');
        
    }


    /**
     * Remove All resource from storage with $id.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function multiDelete(Request $ticket_ids)
    {  
       
     $ids = explode(",", $ticket_ids['ticket_ids']);

     foreach ($ids as $id) {

       $del = IssuedTicket::find($id);
      
       $del->delete();
     }
     
     return redirect()->back()->with('success', 'Ticket Record Deleted !!!');
        
    }

    /**
     * Truncate All resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function truncate()
    {
        //
        if( IssuedTicket::truncate() && TicketSetup::truncate() && Ticket::truncate() ) {

            return redirect()->back()->with('success', 'App Reset Successful !!!');
        }
    }

    


}
