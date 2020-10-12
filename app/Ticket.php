<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    //
	protected $table = "tickets";

	public $fillable = ['name', 'created_at', 'updated_at'];
	

}
