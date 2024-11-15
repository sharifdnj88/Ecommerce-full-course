@extends('layouts.admin')

@section('admin_content')
<div class="page-wrapper">			
    <div class="content container-fluid">        
        @include('layouts.admin_partial.page_header')

        <div class="row">
            <div class="col-lg-12">
                <div class="card shadow-lg">
                    <div class="card-header">
                        <h4 class="card-title">Setting SMTP</h4>
                    </div>
                    <div class="card-body">
                        <form action="{{route('setting.smtp.update', $smtp->id)}}" method="POST">
                            @csrf
                            <div class="form-group row">
                                <label class="col-form-label col-md-2">Mail Mailer</label>
                                <div class="col-md-10">
                                    <input name="mailer" value="{{$smtp->mailer}}" type="text" class="form-control">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-form-label col-md-2">Mail Host</label>
                                <div class="col-md-10">
                                    <input name="host" value="{{$smtp->host}}" type="text" class="form-control">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-form-label col-md-2">Mail Port</label>
                                <div class="col-md-10">
                                    <input name="port" value="{{$smtp->port}}" type="text" class="form-control">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-form-label col-md-2">Mail Username</label>
                                <div class="col-md-10">
                                    <input name="user_name" value="{{$smtp->user_name}}" type="text" class="form-control">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-form-label col-md-2">Mail Password</label>
                                <div class="col-md-10">                                    
                                    <input name="password" value="{{$smtp->password}}" type="text" class="form-control">
                                </div>
                            </div>                           
                            <div class="form-group row">
                                <label class="col-form-label col-md-2">Mail Address</label>
                                <div class="col-md-10">
                                    <input name="address" value="{{$smtp->address}}" class="form-control" type="text">
                                </div>
                            </div>                         
                            <div class="form-group row text-center">
                                <div class="col-md-12">
                                    <button type="submit" class="btn btn-success btn-lg shadow-lg" style="width:30%;">Submit</button>                                    
                                </div>
                            </div>                            
                        </form>
                    </div>
                </div>
            </div>
        </div>   

    </div>			
</div>


@endsection
