@extends('layouts.main')

@section('content')
                <!-- start Page Bar/Title -->
                <div class="page-bar">
                    <div class="page-title-breadcrumb">
                        <div class=" pull-left">
                            <div class="page-title">User Management </div>
                        </div>
                        <ol class="breadcrumb page-breadcrumb pull-right">
                            <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item" href="/"></a>&nbsp;<i class="fa fa-angle-right"></i>
                            </li>
                            <li class="active">User</li>
                        </ol>
                    </div>
                </div>
                <!-- end Page Bar/Title -->
                
                <div class="container">
                    <div class="row"> <!-- start row -->
                        <div class="col-md-12"> <!-- start col -->
                            @include('inc.msg')
                            <div class="row">  <!-- start row -->
                            <div class="col-md-4"> <!-- start col -->
                                <div class="card card-box">
                                <div class="card-head">
                                    <?php
                                    if($editable) {
                                        $method = 'PUT';
                                        $act = 'Update';
                                        $action = 'user.update';
                                        $btn = 'Update'; 
                                    }
                                    else {
                                        $method = 'POST';
                                        $act = 'Add';
                                        $action = 'user.store';
                                        $btn = 'Submit';
                                    }
                                    ?>
                                    <header> {{ $act }} New User </header>
                                </div>
                                <div class="card-body " id="bar-parent">
                                    {!! Form::model($user, [
                                            'method' => $method,
                                            'route' => [$action, $user->id]
                                        ]) !!}
                                        <div class="form-group">
                                            <label for="simpleFormFirstName"> Full Name</label>
                                            <input type="text" value="{{ $user->name }}" class="form-control" name="full_name" placeholder="Enter User Full Name ">
                                            @if ($errors->has('full_name'))
                                                <span class="alert alert-danger">
                                                    <strong>{{ $errors->first('full_name') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                        <div class="form-group">
                                            <label for="simpleFormFirstName"> User Name</label>
                                            <input type="text" value="{{ $user->username }}" class="form-control" name="username" placeholder="Enter User Name ">
                                            @if ($errors->has('username'))
                                                <span class="alert alert-danger">
                                                    <strong>{{ $errors->first('username') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                        <div class="form-group">
                                            <label for="simpleFormFirstName"> Email </label>
                                            <input type="email" value="{{ $user->email }}" class="form-control" name="email" placeholder="Enter Email Address ">
                                            @if ($errors->has('email'))
                                                <span class="alert alert-danger">
                                                    <strong>{{ $errors->first('email') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                        <div class="form-group">

                                            <label for="simpleFormFirstName"> Role </label>
                                            {!! Form::select('role', App\Role::pluck('display_name', 'id'),  $user->exists ? $user->roles[0]->id : null , ['placeholder' => 'Select Role', 'class' => 'form-control' ]) !!}
                                            @if ($errors->has('role'))
                                                <span class="alert alert-danger">
                                                    <strong>{{ $errors->first('role') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                        <div class="form-group">
                                            <label for="simpleFormPassword">Password</label>
                                            <input type="password" name="password" class="form-control" placeholder="Password">
                                            @if ($errors->has('password'))
                                                <span class="alert alert-danger">
                                                    <strong>{{ $errors->first('password') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                        <div class="form-group">
                                            <label for="simpleFormPassword">Confirm Password</label>
                                            <input type="password" class="form-control" name="password_confirmation" placeholder="Password">
                                        </div>
                                        <button type="submit" class="btn btn-primary"> {{ $btn }} !</button>
                                    </form>
                                </div>
                            </div>
                            </div> <!-- end col -->
                            <div class="col-md-8"> <!-- start col -->
                                <div class="card card-topline-red"> 
                                    <div class="card-head">
                                        <header> Users </header>
                                    </div>
                                    <div class="card-body ">
                                        <div class="table-scrollable">
                                            <table class="table table-striped table-hover">
                                                <thead>
                                                    <tr>
                                                        <th> # </th>
                                                        <th> Name </th>
                                                        <th> Username </th>
                                                        <th> Email </th>
                                                        <th> Role </th>
                                                        <th> Status </th>
                                                        <th> Action </th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                @foreach( $users as $i => $user )
                                                    <tr>
                                                        <td> {{ $i+1 }} </td>
                                                        <td> {{ $user->name }} </td>
                                                        <td> {{ $user->username }}  </td>
                                                        <td> {{ $user->email }}  </td>
                                                        <td> {{ $user->roles[0]->name }} </td>
                                                        <td> {{ $user->status( $user->status ) }} </td>
                                                        <td>
                                                            <a title="Edit User!!" href="{{ route('user.edit', $user->slug) }}" class="btn btn-primary btn-xs">
                                                                <i class="fa fa-pencil"></i>
                                                            </a>
                                                        @if( $user->id != 1 )
                                                            {!! Form::open(['method' => 'DELETE', 'style' => 'display:inline;', 'route' => ['user.destroy', $user->id]] ) !!}
                                                            <button title="Change Status!!" class="btn btn-warning btn-xs" type="submit" onclick=" return confirm('Are you Sure you want to Change User Status ?')"  class="btn btn-small btn-danger">
                                                            <i class="fa fa-podcast"></i></button>
                                                            {!! Form::close() !!}
                                                        @endif
                                                        </td>
                                                    </tr>
                                                @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div> <!-- end col -->
                            </div> <!-- end row -->
                        </div> <!-- end col -->
                    </div> <!-- end row -->
                </div>
                <!-- end Page Content -->


@endsection

