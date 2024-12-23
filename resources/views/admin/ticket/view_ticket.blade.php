@extends('layouts.admin')

@section('admin_content')
<div class="page-wrapper">			
    <div class="content container-fluid">        
        @include('layouts.admin_partial.page_header')


    <div class="row">
        <div class="col-sm-12">
            <div class="card shadow">
                <div class="card-header text-center">
                    <h3 class="card-title btn btn-secondary btn-lg">Customer Ticket Details</h3>                    
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-9">
                            <div class="ticket-details d-flex flex-column">
                                <strong class="text-danger">User Name: <span class="text-dark">{{$ticket->name }}</span> </strong>
                                <strong class="text-danger">Subject: <span class="text-dark">{{$ticket->subject}} </span> </strong>
                                <strong class="text-danger">Service: <span class="text-dark"> {{$ticket->service}} </span></strong>
                                <strong class="text-danger">Priority: <span class="text-dark"> {{$ticket->priority}} </span></strong>
                                <strong class="text-danger">Message: <span class="text-dark"> {{$ticket->message}} </span></strong>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="ticket-image text-center">
                                @isset($ticket -> image)
                                <a href="{{url('storage/ticket/' .$ticket -> image)}}" target="_blank">
                                    <img src="{{url('storage/ticket/' .$ticket -> image)}}" alt="{{$ticket->subject}}" width="100%" height="110">
                                </a>
                                @endisset
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-header" style="background-color: #e9e9e9">
                                    <strong>Reply Ticket Message</strong>
                                </div>
                                <div class="card-body">
                                    <form action="{{route('admin.reply.store')}}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                        <div class="form-group">
                                            <label">Message</label>
                                            <textarea name="message" class="form-control"></textarea>
                                            <small id="emailHelp" class="form-text text-muted">Write your message</small>
                                        </div> 
                                        <input type="hidden" name="ticket_id" value="{{$ticket->id}}">
                                        <div class="form-group">
                                            <label">Image</label>
                                            <input name="image" type="file" class="form-control">
                                        </div> 
                                        <div class="form-group">
                                            <button type="Submit" class="btn btn-success">Reply Message</button>
                                        </div>                                         
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card" style="height:400px;overflow-x:hidden;overflow-y: scroll;">
                                <div class="card-header d-flex justify-content-between" style="background-color: #e9e9e9;position:sticky;top:0px;z-index:999;">
                                    <strong>All Replies Message</strong>
                                    <a href="{{route('admin.close.ticket',$ticket->id)}}" class="text-danger"><i class="fa fa-trash"></i></a>
                                </div>
                                <div class="card-body">
                                    @php
                                        $replies=DB::table('replies')->where('ticket_id',$ticket->id)->get();
                                    @endphp
                                    @isset($replies)	
        		                    @foreach($replies as $row)
                                    @if($row->user_id==0)
                                    <div class="card mr-5 d-flex flex-row" style="padding:5px 0px;width:100%;border:none;">
                                        <div class="message-img ml-2">
                                            <a href="#" class="mr-2">
                                                <img src="http://localhost:8000/storage/ticket/payment-not-come_704e0e4ebd3b785d5f854819147e1840.jpg" width="50" height="50" style="border-radius: 50%;object-fit:cover;border:2px solid #000" alt="">
                                            </a>
                                        </div>
                                        <div class="ticket-date">
                                            <div class="message-desc text-justify p-2 text-dark" style="border-radius: 5px;background-color:#ACDDDE;">
                                                <strong class="text-success d-block" style="padding: 0px 10px;">Admin</strong>
                                                <p style="padding: 0px 10px">{{$row->message}}</p>
                                            </div>
                                            <span style="color: grey;font-size:12px;text-align:center;display:block;margin-top:10px;">{{date('d F , Y'), strtotime($row->reply_date)}}</span>
                                        </div>
                                    </div>
                                    @else
                                    {{-- Customer --}}
                                    <div class="card d-flex flex-row-reverse" style="width:100%;border:none;">
                                        <div class="message-img ml-2">
                                            <span class="d-flex justify-content-end align-items-center" style="gap: 5px">
                                                <a href="#">
                                                    <img src="http://localhost:8000/storage/ticket/payment-not-come_704e0e4ebd3b785d5f854819147e1840.jpg" width="50" height="50" style="border-radius: 50%;object-fit:cover;border:2px solid #000" alt="">
                                                </a>
                                            </span>
                                        </div>
                                        <div class="ticket-date">
                                            <div class="message-desc text-justify p-2" style="border-radius: 5px;background-color:#F7D8BA;">
                                                <strong class="text-danger d-block" style="padding: 0px 10px;text-align:end">{{Auth::User()->name}}</strong>
                                                <p style="padding: 0px 10px">{{$row->message}}</p>
                                            </div>
                                            <span style="color: grey;font-size:12px;text-align:center;display:block;margin-top:10px;">{{date('d F , Y'), strtotime($row->reply_date)}}</span>
                                        </div>
                                    </div>
                                    @endif
                                    @endforeach	
				                    @endisset

                                    
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>     

</div>			
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>



@endsection
