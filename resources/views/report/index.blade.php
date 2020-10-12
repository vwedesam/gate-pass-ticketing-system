@extends('layouts.main')

@section('content')
                <!-- start Page Bar/Title -->
                <div class="page-bar">
                    <div class="page-title-breadcrumb">
                        <div class=" pull-left">
                            <div class="page-title"> Ticket Reports for &nbsp; "{{ $date }}"  &nbsp;&nbsp;
                            @if( Auth::user()->hasPermission('print-reports') )
                                <a target="__blank" href="{{ route('reports.print', $date ) }}" class="btn btn-warning" > <i class="fa fa-print"></i> Print ! </a>
                            @endif
                            </div> 
                        </div>
                        <ol class="breadcrumb page-breadcrumb pull-right">
                            <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item" href="/"></a>&nbsp;<i class="fa fa-angle-right"></i>
                            </li>
                            <li class="active"> Reports </li>
                        </ol>
                    </div>
                </div>
                <!-- end Page Bar/Title -->
                
                <div class="container">
                    <div class="row">
                        <div class="col-md-12"> <!-- col -->
                            <div class="row"> <!-- Ticket View/History  row -->
                            @if( count($tickets) > 0 )
                                @foreach( $tickets as $ticket )
                                <div class="col-lg-4 col-sm-4">
                                    <div class="card text-center">
                                        <div class="card-head ">
                                            <header> {{ $ticket->name }} </header>
                                        </div>
                                        <div class="card-body">
                                            <div class="row" >
                                                <div class="col-lg-6 col-sm-6" >
                                                    <p> No. </p>
                                                    <p data-counter="counterup" 
                                                    data-value=" {{ \App\Helpers\Helpers::getTicketCount($date, $ticket->id) }} ">0</p>
                                                </div>
                                                <div class="col-lg-6 col-sm-6">
                                                    <p> Sales </p>
                                                    <p> &#8358;  {{ \App\Helpers\Helpers::getTicketAmount($date, $ticket->id) }} </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endforeach 
                            @endif
                            </div> <!-- Ticket View/History end  row -->
                        </div> <!-- end col -->
                        <div class="col-md-12 col-sm-12">  <!-- start Col -->
                            <div class="row"> <!-- Total Ticket View/History  row -->
                                <div class="col-lg-6 col-sm-6">
                                    <div class="card text-center">
                                        <div class="card-head ">
                                            <header> Total No. </header>
                                        </div>
                                        <div class="card-body blue-bgcolor">
                                            <p class="pt-2" style="font-size:25px;" data-counter="counterup" data-value="{{ count($total_count) }}">0</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-sm-6">
                                    <div class="card text-center">
                                        <div class="card-head blue-bgcolor">
                                            <header> Total Sales </header>
                                        </div>
                                        <div class="card-body">
                                           <p class="pt-2"> <span style="font-size:25px;"> &#8358; </span> <span style="font-size:25px;" data-counter="counterup" data-value="{{ number_format($total_amount) }}">0</span>  </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div> <!-- end col -->
                        <div class="col-md-12 col-sm-12">
                            <br>
                            <br>
                            <div class="card  card-box">
                                <div class="card-head">
                                    <header> Ticket Details</header>
                                    <div class="pull-right">
                                        <!-- Filter by date -->
                                        <label> <strong> Date: </strong> </label>
                                        <input type="date" id="ticket_date" value="{{ $date }}"> &nbsp; &nbsp; &nbsp; &nbsp;
                                        <form style="display:inline;" id="multiDeleteForm" method="POST" action="{{ route('issued-ticket.multiDelete') }}" > 
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

        /// get Ticket Reports By Date
            const ticket_date = document.querySelector('#ticket_date'); 

            ticket_date.addEventListener('change', function(e){

                let currentUrl = document.URL;

                const q = e.target.value;
                
                // check if ticket_type exist in the Query String
                if( /date?=?[a-zA-Z]+/.test(currentUrl) ){

                    // get Old Query String
                    let old_q = currentUrl.split('=')[1]

                    // replace Old With new Query String
                    currentUrl = currentUrl.replace(old_q, q);

                    location.href = currentUrl;

                }else{

                    location.href = `${currentUrl}?date=${q}`;
                }

            });


        })

    </script>

@endsection

