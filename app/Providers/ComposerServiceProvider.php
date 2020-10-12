<?php

namespace App\Providers;

use App\IssuedTicket;
use App\OrganizationInfo;
use App\Ticket;
use App\TicketSetup;
use App\User;
use Illuminate\Support\ServiceProvider;


class ComposerServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        // Load Varaibel
        view()->composer('ticket.manage_ticket', function($view){

            $tickets = Ticket::all();

            return $view->with(['tickets' => $tickets ]);
        });

        view()->composer('ticket.setup_ticket', function($view){

            $ticket_setups = TicketSetup::with('ticket')->get();

            return $view->with(['ticket_setups' => $ticket_setups ]);
        });

        view()->composer('layouts.main', function($view){

            $tickets = Ticket::all();

            $org_info = OrganizationInfo::get()->first();

            return $view->with(['tickets' => $tickets, 'org_info' => $org_info ]);
        });

        view()->composer('home', function($view){

            $total_count = IssuedTicket::where('created_at', 'like', '%'.date('y-m-d').'%')->pluck('total');
            $total_amount  = array_sum($total_count->toArray());

            $all_ticket = Ticket::pluck('id', 'name');

            return $view->with(['total_amount' => $total_amount, 'total_count' => $total_count, 'all_ticket' => $all_ticket ]);
        });


        view()->composer('user.index', function($view){

            $users = User::with('roles')->get();

            return $view->with(['users' => $users]);
        });

        
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
