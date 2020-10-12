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
                            <br>
                            <div class="card  card-box">
                                <div class="card-head">
                                    <header> Assign Permission For {{ $role->display_name }} </header>
                                </div>
                                <form method="POST" action="{{ route('permission.update', $role->id) }}">
                                    @csrf
                                    <input type="hidden" name="_method" value="PUT">
                                    <div class="card-body ">
                                        <div class="form-group">
                                        @foreach( $permissions as $permission )
                                            <div class="checkbox checkbox-icon-black p-0">
                                                <input id="checkbox1" 
                                                <?php if( $role->hasPermission(["$permission->name"]) ){
                                                    echo 'checked'; }  
                                                ?>
                                                 name="assign_permission[]" value="{{ $permission->id }}" type="checkbox">
                                                <label for="checkbox1">
                                                    {{ $permission->display_name }}
                                                </label>
                                            </div>
                                        @endforeach
                                        </div>  
                                    </div>
                                    <div class="card-footer">
                                        <button type="submit" name="assign_btn" class="btn btn-primary">asign Permission</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end Page Content -->


@endsection

