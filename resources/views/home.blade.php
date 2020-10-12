@extends('layouts.main')

@section('content')
                <!-- start Page Bar/Title -->
                <div class="page-bar">
                    <div class="page-title-breadcrumb">
                        <div class=" pull-left">
                            <div class="page-title"> Dashboard </div>
                        </div>
                        <ol class="breadcrumb page-breadcrumb pull-right">
                            <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item" href="/"></a>&nbsp;<i class="fa fa-angle-right"></i>
                            </li>
                            <li class="active"> Dashboard </li>
                        </ol>
                    </div>
                </div>
                <!-- end Page Bar/Title -->
                
                <div class="container">
                    <div class="row">
                        <div class="col-md-12"> <!-- col -->
                            @include('inc.msg')
                            <div class="state-overview"> <!-- start Overview -->
                                <div class="row">
                                    <div class="col-lg-5 col-sm-5">
                                        <div class="overview-panel orange">
                                            <div class="symbol">
                                                <i class="fa fa-linux"></i>
                                            </div>
                                            <div class="value white">
                                                <p class="sbold addr-font-h1" data-counter="counterup" data-value="{{ count($total_count) }}">0</p>
                                                <p>Today's Ticket</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-7 col-sm-7">
                                        <div class="overview-panel blue-bgcolor">
                                            <div class="symbol">
                                                <i class="fa fa-money"></i>
                                            </div>
                                            <div class="value white">
                                                <p class="sbold addr-font-h1" data-counter="counterup" data-value="{{ number_format($total_amount) }}">0</p><span> &#8358; </span>
                                                <p> Today's Ticket Sales </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div> <!-- end Overview -->
                        </div> <!-- end col -->
                        <div class="col-md-12 col-sm-12">
                            <br>
                            <div class="card  card-box">
                                <div class="card-head">
                                    <header> Ticket Details</header>
                                    <div class="pull-right">
                                        <form id="multiDeleteForm" method="POST" action="{{ route('issued-ticket.multiDelete') }}" > 
                                            @csrf
                                            <input type="hidden" name="_method" value="DELETE">
                                            <input type="hidden" id="ticket_ids" name="ticket_ids">
                                            <button type="button" id="btnMultiDelete" class="btn btn-danger">
                                                Delete Selected item
                                            </button>
                                        </form>
                                    </div>
                                </div>
                                <div class="card-body ">
                                  <div class="table-wrap">
                                        <div class="table-responsive">
                                            <table class="table display product-overview mb-30" id="support_table5">
                                                <thead>
                                                    <tr>
                                                        <th> * </th>
                                                        <th> Ticket </th>
                                                        <th> Ticket type </th>
                                                        <th> No. of Persons </th>
                                                        <th> Issued By </th>
                                                        <th> Date  </th>
                                                        <th> Total </th>
                                                        <th> Action </th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                @if( count($issued_tickets) > 0  )
                                                    @foreach( $issued_tickets as  $i => $issued_ticket  )
                                                    <tr>
                                                        <td> &nbsp; <input type="checkbox" value="{{ $issued_ticket->id }}" class="ticket_box"> 
                                                            {{ $issued_ticket->ticket_num }}
                                                        </td>
                                                        <td> {{ $issued_ticket->ticket->name }} </td>
                                                        <td> {{ ucfirst($issued_ticket->ticket_type) }} 
                                                        </td>
                                                        <td title="A = Number of Adult __ C = Number of Children">
                                                          @if( $issued_ticket->no_of_adult != 0 )
                                                          A({{ $issued_ticket->no_of_adult }}) 
                                                          @endif 
                                                          
                                                          @if( $issued_ticket->no_of_children != 0 )
                                                          C({{ $issued_ticket->no_of_children }})
                                                          @endif 
                                                        </td>
                                                        <td> {{ explode(" ", $issued_ticket->user->name)[1] ?? explode(" ", $issued_ticket->user->name)[0] }} </td>
                                                        <td> {{ date('M d, Y', strtotime($issued_ticket->created_at) ) }} </td>
                                                        <td> &#8358; {{ number_format($issued_ticket->total) }} </td>
                                                        <td>
                                                        @if( Auth::user()->hasPermission('reprint-ticket') )
                                                            <a target="__blank" href="{{ route('issued-ticket.print', $issued_ticket->id) }}" class="btn btn-warning">
                                                               <i class="fa fa-print "></i> &nbsp; print
                                                            </a>
                                                        @else
                                                            ----
                                                        @endif
                                                        </td>
                                                    </tr>
                                                    @endforeach
                                                @endif
                                                </tbody>
                                            </table>
                                            <div>
                                                <br>
                                                {{ $issued_tickets->links() }}
                                            </div>
                                        </div>
                                    </div>  
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end Page Content -->


@endsection

@section('script')

    <script src="assets/plugins/counterup/jquery.waypoints.min.js" ></script>
    <script src="assets/plugins/counterup/jquery.counterup.min.js" ></script>
    <script type="text/javascript">

        $(document).ready(function(){

        // MultiDelete Ticket By Ids

        document.getElementById("btnMultiDelete").addEventListener('click', function(e){

            const src = document.getElementsByClassName('ticket_box');
            const ticket_ids = [];
             
            for( let i = 0; i < src.length; i++){
              
              if(src[i].checked){
              
              ticket_ids.push(src[i].value);
              
              }
             }
              
             if( ticket_ids.length == 0 ) {
              alert("select at least one item");
             }else{

                if(confirm(' Are Your Sure?? ')){
                    document.getElementById("ticket_ids").value = ticket_ids;
                    document.getElementById("multiDeleteForm").submit();
                }
              
             }

            });


        })

    </script>

@endsection

