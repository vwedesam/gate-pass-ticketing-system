<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Ticket;


class TicketController extends Controller
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
        $ticket = new Ticket();

        $editable = false;

        return view('ticket.manage_ticket', compact('ticket', 'editable'));

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
            'name' => 'required'
            ]);

        $ticket = new Ticket();
        $ticket->name = $request->name;
        $ticket->slug = Str::slug($request->name);
        $ticket->save();

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
        $ticket = Ticket::findOrFail($id);

        $editable = true;

        return view('ticket.manage_ticket', compact('ticket', 'editable'));
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
            'name' => 'required'
            ]);

        unset($request['_token']);
        unset($request['_method']); // remove _token Before Upload
        $request['slug'] = Str::slug($request->name);

        if ( Ticket::find($id)->update($request->all()) ){

            return redirect()->route('ticket.index')->with('success', 'Ticket Updated Succesfully !!');

        }
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
        //
        try{
            Ticket::findOrFail($id)->delete();

            return redirect()->back()->with('success', 'Ticket Deleted !');

        }catch(\Illuminate\Database\QueryException $e){

        return redirect()->back()->with('error', 'Ticket Cannot be Deleted !');

       }
    }
}
