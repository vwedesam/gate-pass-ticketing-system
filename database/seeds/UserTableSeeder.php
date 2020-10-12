<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\User;


class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('users')->insert([
        	'name' => 'Super Admin',
        	'username' => 'Admin@123',
            'slug' => Str::slug('super-admin'),
        	'email' => 'admin@gmail.com',
            'status' => 1,
        	'password' => bcrypt('secret'),
        	]);

        //
        DB::table('organization_info')->insert([
            'name' => '... Change Me ...',
            ]);

    }
}
