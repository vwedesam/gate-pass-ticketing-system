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
                            <li class="active"> Edit Ticket </li>
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
                            {{ Form::model($ticket_setup, [
                                'method' => 'PUT',
                                'route' => ['ticket-setup.update', $ticket_setup->id]
                                ]) }}
                                <div class="card-body " id="bar-parent5">
                                    <div class="row">
                                        @csrf
                                        <div class="col-lg-4 col-md-4 col-sm-4 col-4">
                                            <label> Ticket </label>
                                            <select disabled name="ticket_id" class="form-control" required>
                                                <option value=""> {{ $ticket_setup->ticket->name }} </option>
                                            </select>
                                        </div>
                                        <div class="col-lg-4 col-md-4 col-sm-4 col-4">
                                            <label>  Setup type </label>
                                            <select disabled name="setup_type" class="form-control" required>
                                                <option value=""> {{ $ticket_setup->setup_type }} </option>
                                            </select>
                                        </div>
                                        <div class="col-lg-4 col-md-4 col-sm-4 col-4">
                                            <label>  Cost </label>
                                            <input type="number" value="{{ $ticket_setup->cost }}" name="cost" min="1" class="form-control" placeholder="Enter Cost..." required>
                                        </div>
                                    </div>
                                    
                                </div> 
                                <div class="card-footer ">
                                    <button type="submit" class="btn btn-primary"> Update Setup ! </button>
                                </div> 
                            </form>
                        </div>
                        </div> <!-- end col -->
                        
                    </div>
                </div>
                <!-- end Page Content -->

@endsection

