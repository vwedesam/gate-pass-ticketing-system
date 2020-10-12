<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\TicketSetup;
use App\Ticket;
use App\User;


class IssuedTicket extends Model
{
    //
    protected $table = "issued_ticket";

    // protected $attributes = [
    //    'no_of_adult' => 0,
    //    'no_of_children' => 0,
    // ];


    public function getRouteKeyName(){
        return 'slug';
    }

    /**
     *  
     *  @param --
     *  @return boolean 
     */

    public function user()
    {
        return $this->belongsTo(User::class, 'issued_by');
    }

    /**
     *  
     *  @param --
     *  @return boolean 
     */
    public function ticket()
	{
		return $this->belongsTo(Ticket::class);
	}


}
