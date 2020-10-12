@extends('layouts.main')

@section('content')
                <!-- start Page Bar/Title -->
                <div class="page-bar">
                    <div class="page-title-breadcrumb">
                        <div class=" pull-left">
                            <div class="page-title"> Role Management </div>
                        </div>
                        <ol class="breadcrumb page-breadcrumb pull-right">
                            <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item" href="/"></a>&nbsp;<i class="fa fa-angle-right"></i>
                            </li>
                            <li class="active"> Role Mangement </li>
                        </ol>
                    </div>
                </div>
                <!-- end Page Bar/Title -->
                
                <div class="container">
                    <div class="row">
                        <div class="col-md-12 col-sm-12">
                            @include('inc.msg')
                            <div class="row"> <!-- strat Row -->
                                <div class="col-md-6 col-sm-6"> <!-- strat Col -->
                                </div>
                                <div class="col-md-6 col-sm-6"> <!-- strat Col -->
                                    <div class="card card-box">
                                        <div class="card-head">
                                            <header> New Role </header>
                                        </div>
                                        <div class="card-body " id="bar-parent5">
                                        <form method="POST" action="{{ route('role.store') }}" >
                                            <div class="row">
                                                @csrf
                                                <div class="col-lg-8 col-md-8 col-sm-8 col-8">
                                                    <label>  Name </label>
                                                    <input type="text" name="name" class="form-control" placeholder="Enter Role Name ..." required>
                                                </div>
                                                <div class="col-lg-4 col-md-4 col-sm-4 col-4">
                                                    <p> </p><p> </p>
                                                    <button type="submit" class="btn btn-primary"> Create ! </button>
                                                </div>
                                            </div>
                                        </form>
                                        </div>  
                                    </div>
                                </div> <!-- end Col -->
                            </div> <!-- end Row -->
                            <br>
                            <div class="card  card-box">
                                <div class="card-head">
                                    <header> Roles </header>
                                </div>
                                <div class="card-body ">
                                  <div class="table-wrap">
                                        <div class="table-responsive">
                                            <table class="table display product-overview mb-30" id="support_table5">
                                                <thead>
                                                    <tr>
                                                        <th> s/n </th>
                                                        <th> Role Name </th>
                                                        <th> Date Created </th>
                                                        <th> Date Updated </th>
                                                        <th> Action </th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                @if( count($roles) > 0  )
                                                    @foreach( $roles as  $i => $role  )
                                                    <tr>
                                                        <td> {{ $i+1 }} </td>
                                                        <td> {{ $role->name }} </td>
                                                        <td> {{ date('M d, Y', strtotime($role->created_at) ) }} </td>
                                                        <td> {{ date('M d, Y', strtotime($role->updated_at) ) }} </td>
                                                        <td>
                                                        @if( $role->id == 1 )
                                                            <button disabled="true">
                                                               <i class="fa fa-plus-circle"></i> &nbsp; Assign Permission
                                                            </button>
                                                        @else
                                                            <a href="{{ route('role.show', $role->display_name ) }}" class="btn btn-info">
                                                               <i class="fa fa-plus-circle"></i> &nbsp; Assign Permission
                                                            </a>
                                                        @endif
                                                        </td>
                                                    </tr>
                                                    @endforeach
                                                @endif
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>  
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end Page Content -->


@endsection

