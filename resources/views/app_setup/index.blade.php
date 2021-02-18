@extends('layouts.main')

@section('content')
                <!-- start Page Bar/Title -->
                <div class="page-bar">
                    <div class="page-title-breadcrumb">
                        <div class=" pull-left">
                            <div class="page-title">  App Management </div>
                        </div>
                        <ol class="breadcrumb page-breadcrumb pull-right">
                            <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item" href="/"></a>&nbsp;<i class="fa fa-angle-right"></i>
                            </li>
                            <li class="active"> App Management </li>
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
                                    <div class="card card-box">
                                        <div class="card-head">
                                            <header> Organization Name  </header>
                                        </div>
                                        <div class="card-body " id="bar-parent5">
                                        <form method="POST" action="{{ route('organization.update', $org_info->id) }}" >
                                            <div class="row">
                                                @csrf
                                                <div class="col-lg-8 col-md-8 col-sm-8 col-8">
                                                    <label> Organization Name </label>
                                                    <input maxlength="11" type="text" name="name" class="form-control" value="{{ $org_info->name }}" placeholder="Enter Organization Name ..." required>
                                                </div>
                                                <div class="col-lg-4 col-md-4 col-sm-4 col-4">
                                                    <p> </p><p> </p>
                                                    <button type="submit" class="btn btn-primary"> Save ! </button>
                                                </div>
                                            </div>
                                        </form>
                                        </div>  
                                    </div>
                                </div> <!-- end Col -->
                                <div class="col-md-6 col-sm-6"> <!-- strat Col -->
                                    {!! Form::open(['method' => 'DELETE', 'style' => 'display:inline;', 'route' => ['issued-ticket.truncate']] ) !!}
                                        <button class="btn btn-danger btn-lg" type="submit" onclick=" return confirm('this Action cannot be undone Are you Sure ??')"  class="btn btn-small btn-danger">
                                        <i class="fa fa-trash-o " > Reset App </i></button>
                                    {!! Form::close() !!}
                                    <p> This will Delete All Ticket History (which include Ticket Price Setup And Issued Tickets ) </p>
                                </div>
                            </div> <!-- end Row -->
                            <hr/>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="card card-box">
                                        <div class="card-head">
                                            <header> Manage Database  </header>
                                        </div>
                                        <div class="card-body " id="bar-parent5">
                                        <div class="row">
                                            <div class="col-md-8 border-right">
                                            <form enctype="multipart/form-data" method="POST" action="{{ route('organization.import_db') }}" >
                                                @csrf
                                                <label> Import (gzip, bzip2, zip, sql) </label>
                                                <input type="file" name="sql" class="form-control" required>
                                                <p> </p><p> </p>
                                                <button type="submit" class="btn btn-primary"> Import ! </button>
                                            </form>
                                            </div> <!-- End Col- ---->
                                            <div class="col-md-4">
                                               <form method="POST" action="{{ route('organization.export_db') }}" >
                                                    @csrf
                                                    <button type="submit" class="btn btn-success"> Export ! </button>
                                                </form>
                                            </div> <!-- col end -->
                                        </div> <!-- row end -->
                                        </div>  <!-- card body end -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end Page Content -->


@endsection

