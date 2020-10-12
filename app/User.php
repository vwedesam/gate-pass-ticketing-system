<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laratrust\Traits\LaratrustUserTrait;

class User extends Authenticatable
{
    use LaratrustUserTrait;
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'username', 'email', 'slug', 'status', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function getRouteKeyName(){
        return 'slug';
    }


    /**
     *  Check user Status
     *  @param --
     *  @return boolean 
     */

    public function isNotActive()
    {
        return Auth()->user()->status != 1;
    }



    /**
     *  Check user Status
     *  @param user status
     *  @return html Element
     */

    public static function status($user_status)
    {
        if( $user_status != 1 ) {

           echo  '<span title="Not Active" class="label label-sm label-danger"> <i class="fa fa-times"></i> </span>';
        }else{

            echo '<span title="Active" class="label label-sm label-success"> <i class="fa fa-check"></i> </span>';
        }

    }

}
