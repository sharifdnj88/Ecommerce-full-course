@extends('layouts.admin')

@section('admin_content')
<div class="page-wrapper">			
    <div class="content container-fluid">        
        @include('layouts.admin_partial.page_header')

        <div class="row">
            <div class="col-sm-12">
                <div class="card shadow">
                    <div class="card-header text-center">
                        <h3 class="card-title btn btn-secondary btn-lg">All categories list here</h3>
                        <button class="btn btn-danger btn-lg" data-toggle="modal" data-target="#categoryModal"> <i class="fa fa-plus"></i> Add New Category</button>
                    </div>
                    <div class="card-body">
                        <span style="text-align:center">@include('validate')</span>
                        <div class="table-responsive">
                            <table class="table mb-0 data-table-said table-bordered table-primary table-sm">
                                <thead>
                                    <tr>
                                        <th>SL</th>
                                        <th>Category Name</th>
                                        <th>Category Slug</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($data as $item)
                                        <tr>
                                            <td>{{$loop-> index  + 1}}</td>
                                            <td>{{ $item -> category_name }}</td>
                                            <td>{{ $item -> category_slug }}</td>
                                            <td>
                                                <a href="#" class="btn btn-sm btn-warning edit" data-id="{{ $item->id }}" data-toggle="modal" data-target="#editModal" ><i class="fa fa-edit" ></i></a>                                                
                                                <a href="{{route('category.delete', $item->id)}}" class="btn btn-sm btn-danger" id="delete" ><i class="fa fa-trash" ></i></a>
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

{{-- category insert modal --}}
<div class="modal fade" id="categoryModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Add New Category</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="{{route('category.store')}}" method="Post">
            @csrf
        <div class="modal-body">
            <div class="form-group">
              <label for="category_name">Category Name</label>
              <input type="text" class="form-control" id="category_name" name="category_name" required="">
              <small id="emailHelp" class="form-text text-muted">This is your main category</small>
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

{{-- Edit category modal --}}
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Edit Category</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="{{route('category.update')}}" method="Post">
            @csrf
            <div class="modal-body">
                <div class="form-group">
                <label for="e_category_name">Category Name</label>
                <input type="text" class="form-control" id="e_category_name" name="category_name" required="">
                <input type="hidden" class="form-control" id="e_category_id" name="id">
                <small id="emailHelp" class="form-text text-muted">This is your main category</small>
                </div> 
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            <button type="Submit" class="btn btn-success">Update</button>
            </div>
        </form>
      </div>
    </div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<script type="text/javascript">
	$('body').on('click', '.edit', function(){
        let cat_id =$(this).data('id');
        $.get('category/edit/'+cat_id, function(data){
            console.log(data);            
            $('#e_category_name').val(data.category_name);
            $('#e_category_id').val(data.id);
            
        });
    });

</script>


@endsection
