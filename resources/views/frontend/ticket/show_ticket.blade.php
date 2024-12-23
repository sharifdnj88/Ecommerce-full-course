<div class="card">
    <div class="card-header">
        <h4 class="text-center">Your Ticket Details</h4>
        <hr>
        <div class="ticket-sec d-flex justify-content-between">
            <div class="ticket-details">
                <strong class="text-danger">Subject: <span class="text-dark">{{$ticket->subject}} </span> </strong>
                <p class="text-danger">Service: <span class="text-dark"> {{$ticket->service}} </span></p>
                <p class="text-danger">Priority: <span class="text-dark"> {{$ticket->priority}} </span></p>
                <p class="text-danger">Message: <span class="text-dark"> {{$ticket->message}} </span></p>
            </div>
            @isset($ticket -> image)
            <a href="{{url('storage/ticket/' .$ticket -> image)}}" target="_blank">
                <img src="{{url('storage/ticket/' .$ticket -> image)}}" alt="{{$ticket->subject}}" width="110" height="110">
            </a>
            @endisset
        </div>
    </div>
    <div class="all_reply mt-3">
        {{-- Frontend All Replies --}}
        @php
            $replies=DB::table('replies')->where('ticket_id',$ticket->id)->get();
        @endphp
        <div class="card" style="height:400px;overflow-x:hidden;overflow-y: scroll;">
            <div class="card-header" style="background-color: #e9e9e9;position:sticky;top:0px;z-index:999;">
                <strong>All Replies Message</strong>
            </div>
            <div class="card-body">                
                @isset($replies)	
                @foreach($replies as $row)
                @if($row->user_id==0)
                <div class="card mr-5 d-flex flex-row" style="padding:5px 0px;width:100%;border:none;">
                    <div class="message-img ml-3">
                        <a href="#" class="mr-3">
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
                    <div class="message-img ml-3">
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
    <div class="card-body">
        <strong>Reply Message</strong>
        <form action="{{route('reply.ticket')}}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="reply_form">
            <div class="form-group">
                <label class="required">Message</label>
                <textarea name="message" class="form-control"></textarea>
            </div>
            <input type="hidden" name="ticket_id" value="{{$ticket->id}}">
            <div class="form-group">
                <label>Image</label>
                <input name="image" type="file" class="form-control">
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-danger">Sumbit</button>
            </div>
        </div>
        </form>
    </div>
</div>