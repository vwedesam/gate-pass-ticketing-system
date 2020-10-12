<?php

use Illuminate\Database\Seeder;
use App\Role;
use App\User;
use App\Permission;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
       //DB::table('permissions')->truncate();
        
        // Create Permissions 
        $appManagement = new Permission();
        $appManagement->name = 'app-management';
        $appManagement->display_name = 'App Management/Setup';
        $appManagement->save();

        $userManagement = new Permission();
        $userManagement->name = 'user-management';
        $userManagement->display_name = 'User Management';
        $userManagement->save();

        $roleManagement = new Permission();
        $roleManagement->name = 'role-management';
        $roleManagement->display_name = 'Role Management';
        $roleManagement->save();

        $ticketManagement = new Permission();
        $ticketManagement->name = 'ticket-management';
        $ticketManagement->display_name = 'Ticket Management';
        $ticketManagement->save();

        $ticketSetup = new Permission();
        $ticketSetup->name = 'ticket-setup';
        $ticketSetup->display_name = 'Ticket Price Setup';
        $ticketSetup->save();

        $printReports = new Permission();
        $printReports->name = 'print-reports';
        $printReports->display_name = 'Print Reports';
        $printReports->save();

        $reprintTicket = new Permission();
        $reprintTicket->name = 'reprint-ticket';
        $reprintTicket->display_name = 'Reprint Ticket';
        $reprintTicket->save();
        
        
        // attach Roles to Permission/ Permissions to Roles
        $admin = Role::whereName('admin')->first();
        $staff = Role::whereName('staff')->first();

        $admin->detachPermissions([$appManagement, $userManagement, $roleManagement, $ticketSetup, $ticketManagement, $printReports, $reprintTicket]);
        $admin->attachPermissions([$appManagement, $userManagement, $roleManagement, $ticketSetup, $ticketManagement, $printReports, $reprintTicket]);

        $staff->detachPermissions([$printReports]);
        $staff->attachPermissions([$printReports]);
        
        
    }
}
