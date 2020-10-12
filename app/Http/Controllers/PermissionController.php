<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Role;
use App\Permission;

class PermissionController extends Controller
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
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $this->validate($request, [
            'assign_permission' => 'required'
        ]);


        $role = Role::findOrFail($id);

        $role->detachPermissions();

        $role->attachPermissions($request['assign_permission']);

        return redirect()->route('role.index')->with('success', 'Operation Succesful !!');

    }

    
}
