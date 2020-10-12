<?php

namespace App\Http\Controllers;

use App\OrganizationInfo;
use Illuminate\Http\Request;

class OrganizationInfoController extends Controller
{
    //
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
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $org_info = OrganizationInfo::get()->first();

        return view('app_setup.index', compact('org_info'));
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
            'name' => 'required|string|max:11',
        ]);

        $org_info = OrganizationInfo::findOrFail($id);
        $org_info->name = $request->name;
        $org_info->save();

        return redirect()->back()->with('success', 'Organization Info Updated Successfully !!');
    }

    

}
