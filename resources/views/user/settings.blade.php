@extends('layouts.main')

@section('content')
                <!-- start Page Bar/Title -->
                <div class="page-bar">
                    <div class="page-title-breadcrumb">
                        <div class=" pull-left">
                            <div class="page-title"> Your Info </div>
                        </div>
                        <ol class="breadcrumb page-breadcrumb pull-right">
                            <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item" href="/"></a>&nbsp;<i class="fa fa-angle-right"></i>
                            </li>
                            <li class="active"> Your Info </li>
                        </ol>
                    </div>
                </div>
                <!-- end Page Bar/Title -->
                
                <div class="container">
                    <div class="row"> <!-- start row -->
                        <div class="col-md-8"> <!-- start col -->
                            @include('inc.msg')
                                <div class="card card-box">
                                <div class="card-head">
                                    <header> Update Your Info </header>
                                </div>
                                <div class="card-body " id="bar-parent">
                                    {!! Form::model($user, [
                                            'method' => 'PUT',
                                            'route' => ['user.update', $user->id]
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
                                            <input disabled="true" class="form-control"  type="text" value="{{ $user->roles[0]->name }}" >
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
                                        <button type="submit" class="btn btn-primary"> Save !</button>
                                    </form>
                                </div>
                            </div>
                        
                        </div> <!-- end col -->
                    </div> <!-- end row -->
                </div>
                <!-- end Page Content -->


@endsection

