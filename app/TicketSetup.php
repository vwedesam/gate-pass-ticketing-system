<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Ticket;

class TicketSetup extends Model
{
    //
	protected $table = "ticket_setup";

	public $fillable = ['ticket_id', 'setup_type', 'cost'];


	public function ticket()
	{
		return $this->belongsTo(Ticket::class);
	}

}
