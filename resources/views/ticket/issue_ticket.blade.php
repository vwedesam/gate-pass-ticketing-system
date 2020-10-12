@extends('layouts.main')

@section('content')
                <!-- start Page Bar/Title -->
                <div class="page-bar">
                    <div class="page-title-breadcrumb">
                        <div class=" pull-left">
                            <div class="page-title">Ticket</div>
                        </div>
                        <ol class="breadcrumb page-breadcrumb pull-right">
                            <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item" href="/"></a>&nbsp;<i class="fa fa-angle-right"></i>
                            </li>
                            <li class="active">Ticket</li>
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
                                    <header> Add {{ $ticket->name }} Ticket </header>
                                </div>
                                <div class="card-body " id="bar-parent1">
                                    <div class="form-group row form-horizontal" >
                                        <label for="Tickettype" class="col-sm-2 control-label"> Ticket Type </label>
                                        <div class="col-sm-10">
                                            <?php
                                            $select_normal = "selected='true'";
                                            $select_family = ""; $select_group = "";

                                            switch ($query) {
                                                case 'family':
                                                    $select_family = "selected='true'";
                                                    break;
                                                
                                                case 'group':
                                                    $select_group = "selected='true'";
                                                    break;
                                            }
                                                
                                            ?>
                                            <select id="ticket_type" name="ticket_type" class="form-control" >
                                                <option {{ $select_normal }} value="normal"> Normal </option>
                                                <option {{ $select_family }} value="family"> Family </option>
                                                <option {{ $select_group }} value="group"> Group </option>
                                            </select>
                                        </div>
                                    </div>
                                    <form target="__blank" class="form-horizontal" method="POST" action="{{ route('issued-ticket.store') }}" >
                                     @csrf
                                     <input type="hidden" value="{{ $id }}" name="ticket_id" class="form-control" >
                                    @if( $query == 'family' )
                                    <!-- Family Ticket -->
                                        <br>
                                        <input type="hidden" value="{{ $query }}" name="ticket_type" class="form-control" >
                                        <div class="form-group row">
                                            <label for="horizontalFormAdult" class="col-sm-2 control-label">No. of Adult</label>
                                            <div class="col-sm-10">
                                                <input type="number" name="no_of_adult" min="1" class="form-control" placeholder="No. of Adult..." required >
                                            </div>
                                        </div>
                                        <br>
                                        <div class="form-group row">
                                            <label for="horizontalFormChildren" class="col-sm-2 control-label">No. of Children</label>
                                            <div class="col-sm-10">
                                                <input type="number" name="no_of_children" min="1" class="form-control" placeholder="No. of Children..." required >
                                            </div>
                                        </div>
                                        <br>
                                    @elseif( $query == 'group' )
                                    <!-- Group Ticket -->
                                        <input type="hidden" value="{{ $query }}" name="ticket_type" class="form-control" >
                                        <br>
                                        <div class="form-group row">
                                            <label for="horizontalFormRate" class="col-sm-2 control-label"> Rate </label>
                                            <div class="col-sm-10">
                                                <input type="number" name="rate" min="1" class="form-control" placeholder="Rate ..." required >
                                            </div>
                                        </div>
                                        <br>
                                        <div class="form-group row">
                                            <label for="horizontalFormAdult" class="col-sm-2 control-label">No. of Persons </label>
                                            <div class="col-sm-10">
                                                <input type="number" name="no_of_persons" min="1" class="form-control" placeholder="No. of Persons ..." required  >
                                            </div>
                                        </div>
                                        <br>
                                    @else
                                    <!-- Normal Ticket -->
                                        <input type="hidden" value="{{ $query }}" name="ticket_type" class="form-control" >
                                        <br>
                                        <div class="form-group row">
                                            <label for="horizontalFormAdult" class="col-sm-2 control-label">No. of Adult</label>
                                            <div class="col-sm-10">
                                                <input type="number" name="no_of_adult" min="1" class="form-control" placeholder="No. of Adult..."  >
                                            </div>
                                        </div>
                                        <br>
                                        <div class="form-group row">
                                            <label for="horizontalFormChildren" class="col-sm-2 control-label">No. of Children</label>
                                            <div class="col-sm-10">
                                                <input type="number" name="no_of_children" min="1" class="form-control" placeholder="No. of Children..."  >
                                            </div>
                                        </div>
                                        <br>
                                    @endif
                                        <div class="form-group">
                                            <div class="offset-md-3 col-md-9">
                                                <button type="submit" class="btn btn-primary"> Submit and Print </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>

                        </div> <!-- end col -->
                    </div>
                </div>
                <!-- end Page Content -->


@endsection

@section('script')

    <script type="text/javascript">

        $(document).ready(function(){

        // get Ticket Form By Ticket_type
            const ticketType = document.querySelector('#ticket_type'); 

            ticketType.addEventListener('change', function(e){

                let currentUrl = document.URL;

                const q = e.target.value;
                
                // check if ticket_type exist in the Query String
                if( /ticket_type?=?[a-zA-Z]+/.test(currentUrl) ){

                    // get Old Query String
                    let old_q = currentUrl.split('=')[1]

                    // replace Old With new Query String
                    currentUrl = currentUrl.replace(old_q, q);

                    location.href = currentUrl;

                }else{

                    location.href = `${currentUrl}?ticket_type=${q}`;
                }

            });

        })

    </script>

@endsection


