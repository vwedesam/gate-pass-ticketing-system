<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('check_user_perm')->except(['show', 'update']);
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = new User();

        $editable = false;

        return view('user.index', compact('user', 'editable'));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        //dd($request);

        $this->validate($request, [
            'full_name' => 'required|string|max:20',
            'username' => 'required|max:20',
            'email' => 'required|email|max:255|unique:users',
            'role' => 'required|integer',
            'password' => 'required|min:6|confirmed',
        ]);

        //dd($request);

        $user = User::create([
            'name' => $request['full_name'],
            'username' => $request['username'],
            'slug' => Str::slug($request['full_name']),
            'email' => $request['email'],
            'status' => 0,
            'password' => Hash::make($request['password']),
        ]);

        $user->attachRole($request['role']);

        return redirect()->back()->with('success', 'User Created Successfully !!');

    }


    /**
     *  display a specified resource for editing.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        $user = User::with('roles')->find($id);

        if( Auth()->user()->id != $user->id ){
            return redirect()->route('home')->with('error', ' Action Not Allowed !!');
        }

        $editable = true;

        return view('user.settings', compact('user', 'editable'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
    
        $user = User::with('roles')->where('slug', $id)->get()->first();

        if( $user->id == 1 && Auth()->user()->id != $user->id ){
            return redirect()->back()->with('error', ' Action Not Allowed for this user !!');
        }

        $editable = true;

        return view('user.index', compact('user', 'editable'));
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
            'full_name' => 'required|string|max:20',
            'username' => 'required|max:20',
            'email' => 'required|email',
            'role' => 'integer',
            'password' => 'confirmed',
        ]);

        $user = User::findOrFail($id);

        $user->name = $request['full_name'];
        $user->slug = Str::slug($request['full_name']);
        $user->username = $request['username'];

        if( $user->email != $request['email'] ){
            $user->email = $request['email'];
        }
        if( $request['password'] != null ){
            $user->password = Hash::make($request['password']);
        }


        $user->save();

        if( $request->has('role') && $user->role != $request['role'] ){
            $user->detachRoles();
            $user->attachRole($request['role']);
        }

        return redirect()->back()->with('success', 'User Updated Successfully !!');
    }

    /**
     * Change User Status
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return DB::transaction(function() use ($id) {

            if( $id == 1 ){
                return redirect()->back()->with('error', 'Request Failed!!');
            }
            
            $user = User::findOrFail($id);

            // Change User Status

            if( $user->status == 1 ) $user->status = 0;
            else  $user->status = 1;

            $user->save();

            return redirect()->back();

        });

    }


}
