@extends('layouts.admin')

@section('admin_content')
<div class="page-wrapper">			
    <div class="content container-fluid">        
        @include('layouts.admin_partial.page_header')

        <div class="row">
            <div class="col-lg-12">
                <div class="card shadow-lg">
                    <div class="card-header">
                        <h4 class="card-title">Setting SEO</h4>
                    </div>
                    <div class="card-body">
                        <form action="{{route('setting.seo.update', $data->id)}}" method="POST">
                            @csrf
                            <div class="form-group row">
                                <label class="col-form-label col-md-2">Meta Title</label>
                                <div class="col-md-10">
                                    <input name="meta_title" value="{{$data->meta_title}}" type="text" class="form-control">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-form-label col-md-2">Meta Author</label>
                                <div class="col-md-10">
                                    <input name="meta_author" value="{{$data->meta_author}}" type="text" class="form-control">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-form-label col-md-2">Meta Tag</label>
                                <div class="col-md-10">
                                    <input name="meta_tag" value="{{$data->meta_tag}}" type="text" class="form-control">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-form-label col-md-2">Meta Keyword</label>
                                <div class="col-md-10">
                                    <input name="meta_keyword" value="{{$data->meta_keyword}}" type="text" class="form-control">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-form-label col-md-2">Meta Description</label>
                                <div class="col-md-10">
                                    <textarea name="meta_description" class="form-control textarea">{{$data->meta_description}}</textarea>
                                </div>
                            </div>                            
                            <div class="form-group row">
                                <div class="col-md-12">
                                    <h5 class="text-center"><i class="fa fa-arrow-circle-down"></i> Other</h5>
                                </div>
                            </div>                            
                            <div class="form-group row">
                                <label class="col-form-label col-md-2">Google Verification</label>
                                <div class="col-md-10">
                                    <input name="google_verification" value="{{$data->google_verification}}" class="form-control" type="text">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-form-label col-md-2">Google Absense</label>
                                <div class="col-md-10">
                                    <input name="google_adsense" value="{{$data->google_adsense}}" class="form-control" type="text">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-form-label col-md-2">Alexa Verification</label>
                                <div class="col-md-10">
                                    <input name="alexa_verification" value="{{$data->alexa_verification}}" class="form-control" type="text">
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
