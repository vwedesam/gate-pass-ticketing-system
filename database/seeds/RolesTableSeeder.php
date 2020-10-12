<?php

use Illuminate\Database\Seeder;
use App\Role;
use App\User;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $admin = new Role();               //-------
        $admin->name = 'admin';                //   |
        $admin->display_name = 'Admin';        //   |      
        $admin->save();                        //   |
                                               //   |
        $editor = new Role();                  //   |
        $editor->name = 'staff';              //   |------- Create Roles
        $editor->display_name = 'Staff';      //   |
        $editor->save(); 

        // User1 as Admin                //----------
        $user1 = User::find(1);                //   |
        $user1->detachRole($admin);           //   |
        $user1->attachRole($admin);

    }
}
