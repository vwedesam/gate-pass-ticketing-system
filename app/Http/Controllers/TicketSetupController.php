<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TicketSetup;

class TicketSetupController extends Controller
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
    public function index()
    {
        //
        return view('ticket.setup_ticket');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $this->validate($request, [
            'ticket_id' => 'required',
            'setup_type' => 'required',
            'cost' => 'required'
            ]);

        // Check if ticket has been Setup Already
        if( count(TicketSetup::where(['ticket_id' => $request['ticket_id'], 'setup_type' => $request['setup_type'] ])->get()) > 0 ){
            return redirect()->back()->with('error', 'Ticket has Already been Set Up !');
        }

        $setup = new TicketSetup();

        $setup->ticket_id = $request['ticket_id'];
        $setup->setup_type = $request['setup_type'];
        $setup->cost = $request['cost'];
        $setup->save();

        return redirect()->back();

    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $ticket_setup = TicketSetup::findOrFail($id);

        return view('ticket.ticket_setup_edit', compact('ticket_setup'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
         $this->validate($request, [
            'cost' => 'required'
            ]);

        $setup = TicketSetup::findOrFail($id);

        $setup->cost = $request['cost'];
        $setup->save();

        return redirect()->route('ticket-setup.index')->with('success', 'Ticket Setup Updated !!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        try{
            TicketSetup::findOrFail($id)->delete();

            return redirect()->back()->with('success', 'Ticket Set Up Deleted !');

        }catch(\Illuminate\Database\QueryException $e){

        return redirect()->back()->with('error', 'Ticket SetUp Cannot be Deleted !');

       }

    }
}
