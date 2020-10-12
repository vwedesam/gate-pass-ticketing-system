@extends('layouts.main')

@section('content')
                <!-- start Page Bar/Title -->
                <div class="page-bar">
                    <div class="page-title-breadcrumb">
                        <div class=" pull-left">
                            <div class="page-title"> Ticket </div>
                        </div>
                        <ol class="breadcrumb page-breadcrumb pull-right">
                            <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item" href="/"></a>&nbsp;<i class="fa fa-angle-right"></i>
                            </li>
                            <li class="active"> Price Setup </li>
                        </ol>
                    </div>
                </div>
                <!-- end Page Bar/Title -->
                
                <div class="container">
                    <div class="row">
                        <div class="col-md-12"> <!-- col -->
                        @include('inc.msg')
                        <div class="card card-box">
                            <div class="card-head">
                                <header> Setup Ticket </header>
                            </div>
                            <div class="card-body " id="bar-parent5">
                                <form method="POST" action="{{ route('ticket-setup.store') }}" >
                                <div class="row">
                                    @csrf
                                    <div class="col-lg-4 col-md-4 col-sm-4 col-4">
                                        <label> Ticket </label>
                                        {{ Form::select('ticket_id', App\Ticket::pluck('name', 'id'), '', ['class' => 'form-control', 'placeholder' => ' Select ...', 'required' => 'true']) }}
                                    </div>
                                    <div class="col-lg-3 col-md-3 col-sm-3 col-3">
                                        <label>  Setup type </label>
                                        <select name="setup_type" class="form-control" required>
                                            <option value=""> - Select - </option>
                                            <option value="adult"> Adult </option>
                                            <option value="children"> Children </option>
                                        </select>
                                    </div>
                                    <div class="col-lg-3 col-md-3 col-sm-3 col-3">
                                        <label>  Cost </label>
                                        <input type="number" name="cost" min="1" class="form-control" placeholder="Enter Cost..." required>
                                    </div>
                                    <div class="col-lg-2 col-md-2 col-sm-2 col-2">
                                        <p> </p><p> </p>
                                        <button type="submit" class="btn btn-primary"> Add Setup ! </button>
                                    </div>
                                </div>
                                </form>
                            </div>  
                        </div>
                        </div> <!-- end col -->
                        <div class="col-md-12 col-sm-12">
                            <div class="card  card-box">
                                <div class="card-head">
                                    <header> Ticket Details</header>
                                </div>
                                <div class="card-body ">
                                  <div class="table-wrap">
                                        <div class="table-responsive">
                                            <table class="table display product-overview mb-30" id="support_table5">
                                                <thead>
                                                    <tr>
                                                        <th> * </th>
                                                        <th> Ticket </th>
                                                        <th> Setup type </th>
                                                        <th> Cost </th>
                                                        <th> Action </th>
                                                    </tr>
                                                </thead>
                                                <tbody id="showSetup">
                                                @if( count( $ticket_setups) > 0  )
                                                   @foreach( $ticket_setups as  $i => $ticket_setup  )
                                                    <tr>
                                                        <td> {{ $i+1 }} </td>
                                                        <td> {{ $ticket_setup->ticket->name }} </td>
                                                        <td> {{ $ticket_setup->setup_type }} </td>
                                                        <td> &#8358; {{ number_format($ticket_setup->cost) }} </td>
                                                        <td>
                                                            <a href="{{ route('ticket-setup.edit', $ticket_setup->id) }}" class="btn btn-tbl-edit btn-xs" id="{{ $ticket_setup->id }}" >
                                                                <i class="fa fa-edit "></i>
                                                            </a>
                                                            <form action="{{ route('ticket-setup.destroy', $ticket_setup->id ) }}" method="POST" style="display:inline;">
                                                                @csrf
                                                                <input name="_method" type="hidden" value="DELETE">
                                                                <button onclick="return confirm('Are you Sure ?? ')" class="btn btn-tbl-delete btn-xs">
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
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end Page Content -->

@endsection


