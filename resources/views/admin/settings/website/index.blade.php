@extends('layouts.admin')

@section('admin_content')
<div class="page-wrapper">			
    <div class="content container-fluid">        
        @include('layouts.admin_partial.page_header')

        <div class="row">
            <div class="col-sm-12">
                <div class="card shadow-lg">
                    <div class="card-header text-center">
                        <h3 class="card-title btn btn-secondary btn-lg">All Website Setting</h3>
                        <button class="btn btn-danger btn-lg" data-toggle="modal" data-target="#websiteModal"> <i class="fa fa-plus"></i> Add Website Setting</button>
                    </div>
                    <div class="card-body">
                        <span style="text-align:center">@include('validate')</span>
                        <form>                            
                            @forelse ($website as $item)
                            <div class="form-group row">
                                <div class="col-md-12 text-right d-flex justify-content-between align-items-center">
                                    <a href="#" class="btn btn-sm btn-warning edit" data-id="{{ $item->id }}" data-toggle="modal" data-target="#editModal" ><i class="fa fa-edit" ></i></a>                                                
                                    <label class="col-form-label col-md-2">Favicon <img src="{{url('storage/setting/' .$item -> favicon)}}" class="img-thumbnail"></label>
                                    <a href="{{route('setting.website.delete', $item->id)}}" class="btn btn-sm btn-danger" id="delete" ><i class="fa fa-trash" ></i></a>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-form-label col-md-2">Currency</label>
                                <div class="col-md-10">
                                    <input value="{{$item->currency}}" type="text" class="form-control" disabled>
                                </div>
                            </div>  
                            <div class="form-group row">
                                <label class="col-form-label col-md-2">Phone One</label>
                                <div class="col-md-10">
                                    <input value="{{$item->phone_one}}" type="text" class="form-control" disabled>
                                </div>
                            </div>  
                            <div class="form-group row">
                                <label class="col-form-label col-md-2">Another Phone</label>
                                <div class="col-md-10">
                                    <input value="{{$item->phone_two}}" type="text" class="form-control" disabled>
                                </div>
                            </div>  
                            <div class="form-group row">
                                <label class="col-form-label col-md-2">Main Email</label>
                                <div class="col-md-10">
                                    <input value="{{$item->main_email}}" type="text" class="form-control" disabled>
                                </div>
                            </div>  
                            <div class="form-group row">
                                <label class="col-form-label col-md-2">Support Email</label>
                                <div class="col-md-10">
                                    <input value="{{$item->support_email}}" type="text" class="form-control" disabled>
                                </div>
                            </div> 
                            <div class="form-group row">
                                <label class="col-form-label col-md-2">Logo</label>
                                <div class="col-md-10">
                                    <img src="{{url('storage/setting/' .$item -> logo)}}" class="img-thumbnail" width="220" height="220">
                                </div>
                            </div>  
                            <div class="form-group row">
                                <label class="col-form-label col-md-2">Facebook</label>
                                <div class="col-md-10">
                                    <input value="{{$item->facebook}}" type="text" class="form-control" disabled>
                                </div>
                            </div>  
                            <div class="form-group row">
                                <label class="col-form-label col-md-2">Twitter</label>
                                <div class="col-md-10">
                                    <input value="{{$item->twitter}}" type="text" class="form-control" disabled>
                                </div>
                            </div>  
                            <div class="form-group row">
                                <label class="col-form-label col-md-2">Instragram</label>
                                <div class="col-md-10">
                                    <input value="{{$item->instagram}}" type="text" class="form-control" disabled>
                                </div>
                            </div>  
                            <div class="form-group row">
                                <label class="col-form-label col-md-2">Linkedin</label>
                                <div class="col-md-10">
                                    <input value="{{$item->linkedin}}" type="text" class="form-control" disabled>
                                </div>
                            </div>  
                            <div class="form-group row">
                                <label class="col-form-label col-md-2">Youtube</label>
                                <div class="col-md-10">
                                    <input value="{{$item->youtube}}" type="text" class="form-control" disabled>
                                </div>
                            </div> 
                            <hr>
                            @empty
                                <p class="text-danger text-center font-weight-bold">No records found</p>
                            @endforelse                                                      
                        </form>
                    </div>
                </div>
            </div>
        </div>     

    </div>			
</div>

{{-- brand insert modal --}}
<div class="modal fade" id="websiteModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Add New Website Setting</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="{{route('setting.website.store')}}" method="Post" enctype="multipart/form-data">
            @csrf
            <div class="card-body">
              <div class="form-group">
                <label for="exampleInputEmail1">Currency</label>
                 <select class="form-control" name="currency">
                      <option value="৳">Taka (৳)</option>
                      <option value="$">USD ($)</option>                        
                 </select>
              </div>
              <div class="form-group">
                <label for="exampleInputEmail1">Phone One</label>
                <input name="phone_one" type="text" class="form-control" value="{{old('phone_one')}}" required="">
              </div>
               <div class="form-group">
                <label for="exampleInputEmail1">Phone Two</label>
                <input type="text" class="form-control" name="phone_two" value="{{old('phone_two')}}" required="">
              </div>
              <div class="form-group">
                <label for="exampleInputEmail1">Main Email</label>
                <input type="email" class="form-control" name="main_email" value="{{old('main_email')}}" >
              </div>
               <div class="form-group">
                <label for="exampleInputEmail1">Support Email</label>
                <input type="email" class="form-control" name="support_email" value="{{old('support_email')}}" >
              </div>
              <div class="form-group">
                <label for="exampleInputEmail1">Address</label>
                <input type="text" class="form-control" name="address" value="{{old('address')}}" >
              </div>
             
              <div class="form-group text-center">
                <strong class="text-primary"><i class="fa fa-share-alt-square"></i> Social Link</strong>
              </div>              
              
              <div class="form-group">
                <label for="exampleInputEmail1">Facebook</label>
                <input type="text" class="form-control" name="facebook" value="{{old('facebook')}}" >
              </div>
              <div class="form-group">
                <label for="exampleInputEmail1">Twitter</label>
                <input type="text" class="form-control" name="twitter" value="{{old('twitter')}}" >
              </div>
              <div class="form-group">
                <label for="exampleInputEmail1">Instagram</label>
                <input type="text" class="form-control" name="instagram" value="{{old('instragram')}}" >
              </div>
              <div class="form-group">
                <label for="exampleInputEmail1">Linkedin</label>
                <input type="text" class="form-control" name="linkedin" value="{{old('linkedin')}}" >
              </div>
              <div class="form-group">
                <label for="exampleInputEmail1">Youtube</label>
                <input type="text" class="form-control" name="youtube" value="{{old('youtube')}}" >
              </div>

              <div class="form-group text-center">
                <strong class="text-primary"><i class="fa fa-file-image-o"></i> Logo & Favicon</strong>
              </div>  

              <div class="form-group">
                <label for="exampleInputEmail1">Main Logo</label>
                <input type="file" class="form-control dropify" name="logo" >
              </div>
              <div class="form-group">
                <label for="exampleInputEmail1">Favicon</label>
                <input type="file" class="form-control dropify" name="favicon">
              </div>
            </div>
            <div class="card-footer text-right">
              <button type="submit" class="btn btn-success">Submit</button>
            </div>
          </form>
      </div>
    </div>
</div>

{{-- Edit brand modal --}}
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Edit Website Setting</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div id="modal_body">
            {{-- Data came from edit.blade.php --}}
        </div>
      </div>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<script type="text/javascript">
	$('body').on('click', '.edit', function(){
        let website_id =$(this).data('id');
        $.get('website/edit/'+website_id, function(data){
            $('#modal_body').html(data);
            
        });
    });

</script>


@endsection
