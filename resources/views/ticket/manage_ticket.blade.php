@extends('layouts.main')

@section('content')
                <!-- start Page Bar/Title -->
                <div class="page-bar">
                    <div class="page-title-breadcrumb">
                        <div class=" pull-left">
                            <div class="page-title"> Manage Ticket </div>
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
                            <div class="col-md-5"> <!-- start col -->
                                <div class="card card-box">
                                <div class="card-head">
                                    <?php
                                    if($editable) {
                                        $method = 'PUT';
                                        $act = 'Update';
                                        $action = 'ticket.update';
                                        $btn = 'Update'; 
                                    }
                                    else {
                                        $method = 'POST';
                                        $act = 'Add';
                                        $action = 'ticket.store';
                                        $btn = 'Submit';
                                    }
                                    ?>
                                    <header> {{ $act }} Ticket </header>
                                </div>
                                <div class="card-body " id="bar-parent">
                                    {!! Form::model($ticket, [
                                            'method' => $method,
                                            'route' => [$action, $ticket->id]
                                        ]) !!} 
                                        <div class="form-group">
                                            <label for="simpleFormTicket"> Ticket </label>
                                            <input type="text" value="{{ $ticket->name }}" name="name" class="form-control" id="simpleFormTicket" placeholder="Enter Ticket " required >
                                        </div>
                                        <button type="submit" class="btn btn-primary"> {{ $btn }} !</button>
                                    </form>
                                </div>
                            </div>
                            </div> <!-- end col -->
                            <div class="col-md-7"> <!-- start col -->
                                <div class="card card-topline-red"> 
                                    <div class="card-head">
                                        <header> Tickets </header>
                                    </div>
                                    <div class="card-body ">
                                        <div class="table-scrollable">
                                            <table class="table table-striped table-hover">
                                                <thead>
                                                    <tr>
                                                        <th> # </th>
                                                        <th> Ticket </th>
                                                        <th> Action </th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                @if( count($tickets) > 0  )
                                                   @foreach( $tickets as  $i => $ticket  )
                                                    <tr>
                                                        <td> {{ $i+1 }} </td>
                                                        <td> {{ $ticket->name }} </td>
                                                        <td>
                                                            <a href="{{ route('ticket.edit', $ticket->id ) }}" class="btn btn-primary btn-xs">
                                                                <i class="fa fa-pencil"></i>
                                                            </a>
                                                            <form action="{{ route('ticket.destroy', $ticket->id ) }}" method="POST" style="display:inline;">
                                                                @csrf
                                                                <input name="_method" type="hidden" value="DELETE">
                                                                <button onclick="return confirm('Are you Sure ?? ')" type="submit" class="btn btn-danger btn-xs">
                                                                    <i class="fa fa-trash-o "></i>
                                                                </button>
                                                            </form>
                                                        </td>
                                                    </tr>
                                                    @endforeach
                                                @else
                                                    <tr>
                                                        <td colspan="3"> No Record Found !!  </td>
                                                    </tr>
                                                @endif
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

