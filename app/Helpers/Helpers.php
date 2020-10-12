<?php 

namespace App\Helpers;

use App\IssuedTicket;


class Helpers 
{


	/**
	 *  Check user Permissions
	 *
	 *	@param Request request
	 *	@param actionName
	 *  @return boolean (total ticket Amount)
	 */

	public static function check_perm($request, $actionName = null)
	{
		  // get Current Login User
		$currentUser = $request->user();  
	          
	      // get Current Action Name i.e Controller and Method
	    $currentActionName = is_null($actionName) ? $request->route()->getActionName() :  $actionName ;


	    list($controller, $method) = explode('@', $currentActionName);
	    $controller = str_replace(["App\\Http\\Controllers\\", "Controller"], "", $controller);


	    $controllerMap = [
	    	'OrganizationInfo' => 'app-management',
	    	'User' => 'user-management',
	    	'Role' => 'role-management',
	    	'Permission' => 'role-management',
	    	'Ticket' => 'ticket-management',
	    	'TicketSetup' => 'ticket-setup',
	    	'Report' => 'print-reports',
	    ];

	    // if User does not have permission 
        if( $controller == 'Report' &&  in_array($method, ['index']) ){
            if( !$currentUser->can($controllerMap[$controller]) ){
 			   return false;
 		    }
        }
 		else if( !$currentUser->can($controllerMap[$controller]) ){
 			return false;
 		}
   

        return true;

	}


	/**
	 *  
	 *	@param Ticket Issued date
	 *	@param Ticket Issued id
	 *  @return integer (total ticket Amount)
	 */

	public static function getTicketAmount($date, $ticket_id)
	{

		$total_issued_ticket = IssuedTicket::where('created_at', 'like', '%'.date('Y-m-d', strtotime($date)).'%')->where('ticket_id', $ticket_id)->get()->pluck('total');

        $total_amount  = array_sum($total_issued_ticket->toArray());

		return number_format($total_amount);

	}


	/**
	 *  
	 *	@param Ticket Issued date
	 *	@param Ticket Issued id
	 *  @return integer (total ticket Count)
	 */

	public static function getTicketCount($date, $ticket_id)
	{

		$total_issued_ticket = IssuedTicket::where('created_at', 'like', '%'.date('Y-m-d', strtotime($date)).'%')->where('ticket_id', $ticket_id)->get()->pluck('total');

        $total_count  = count($total_issued_ticket->toArray());

		return number_format($total_count);

	}
	

}


 ?>