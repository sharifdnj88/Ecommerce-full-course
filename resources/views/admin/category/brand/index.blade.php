@extends('layouts.admin')

@section('admin_content')
<div class="page-wrapper">			
    <div class="content container-fluid">        
        @include('layouts.admin_partial.page_header')

        <div class="row">
            <div class="col-sm-12">
                <div class="card shadow">
                    <div class="card-header text-center">
                        <h3 class="card-title btn btn-secondary btn-lg">All Brands list here</h3>
                        <button class="btn btn-danger btn-lg" data-toggle="modal" data-target="#brandModal"> <i class="fa fa-plus"></i> Add New Brand</button>
                    </div>
                    <div class="card-body">
                        <span style="text-align:center">@include('validate')</span>
                        <div class="table-responsive">
                            <table class="table mb-0 data-table-said table-bordered table-primary table-sm brand-table">
                                <thead>
                                    <tr>
                                        <th>SL</th>
                                        <th>Brand Name</th>
                                        <th>Brand Slug</th>
                                        <th>Brand Logo</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($data as $item)
                                        <tr>
                                            <td>{{$loop-> index  + 1}}</td>
                                            <td>{{ $item -> brand_name }}</td>
                                            <td>{{ $item -> brand_slug }}</td>
                                            <td>
                                                <img class="img-thumbnail" src="{{url('storage/brands/' .$item -> brand_logo)}}" alt="" width="120" height="120">
                                            </td>
                                            <td>
                                                <a href="#" class="btn btn-sm btn-warning edit" data-id="{{ $item->id }}" data-toggle="modal" data-target="#editModal" ><i class="fa fa-edit" ></i></a>                                                
                                                <a href="{{route('brand.delete', $item->id)}}" class="btn btn-sm btn-danger" id="delete" ><i class="fa fa-trash" ></i></a>
                                        </td>
                                        </tr>    
                                    @empty
                                        <tr>
                                            <td class="text-danger text-center font-weight-bold" colspan="5">No records found</td>
                                        </tr>
                                    @endforelse
                                    
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>     

    </div>			
</div>

{{-- brand insert modal --}}
<div class="modal fade" id="brandModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Add New Brand</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="{{route('brand.store')}}" method="Post" enctype="multipart/form-data">
            @csrf
            <div class="modal-body">
                <div class="form-group">
                    <label for="brand_name">Brand Name</label>
                    <input type="text" class="form-control" id="brand_name" name="brand_name" required="">
                    <small id="emailHelp" class="form-text text-muted">This is your main brand</small>
                </div> 
                <div class="form-group">
                    <label for="brand_logo">Brand Logo</label>
                    <input type="file" class="dropify" data-height="140" name="brand_logo" required="">
                </div> 
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            <button type="Submit" class="btn btn-success">Submit</button>
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
          <h5 class="modal-title" id="exampleModalLabel">Edit brand</h5>
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
        let brand_id =$(this).data('id');
        $.get('brand/edit/'+brand_id, function(data){
            $('#modal_body').html(data);
            
        });
    });

</script>


@endsection
