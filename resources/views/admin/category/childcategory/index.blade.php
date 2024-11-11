@extends('layouts.admin')

@section('admin_content')
<div class="page-wrapper">			
    <div class="content container-fluid">        
        @include('layouts.admin_partial.page_header')

        <div class="row">
            <div class="col-sm-12">
                <div class="card shadow">
                    <div class="card-header text-center">
                        <h3 class="card-title btn btn-dark btn-lg">All Child-Categories list here</h3>
                        <button class="btn btn-info btn-lg" data-toggle="modal" data-target="#categoryModal"> <i class="fa fa-plus"></i> Add New Subcategory</button>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table mb-0 data-table-said table-bordered table-primary table-sm ytable">
                                <thead>
                                    <tr>
                                        <th>SL</th>
                                        <th>Childcategory Name</th>
                                        <th>Category Name</th>
                                        <th>Subcategory Name</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                   
                                    
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
          <h5 class="modal-title" id="exampleModalLabel">Add New Subcategory</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="{{route('subcategory.store')}}" method="Post">
            @csrf
            <div class="modal-body">
                <div class="form-group">
                <label for="category_id">Category Name</label>
                <select name="category_id" class="form-control" id="" required>
                    {{-- @foreach ($category as $cat)
                        <option value="{{$cat->id}}">{{$cat->category_name}}</option>                    
                    @endforeach --}}
                </select>
                </div> 
                <div class="form-group">
                <label for="subcategory_name">Subcategory Name</label>
                <input type="text" class="form-control" id="subcategory_name" name="subcategory_name" required="">
                <small id="emailHelp" class="form-text text-muted">This is your main subcategory</small>
                </div> 
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            <button type="Submit" class="btn btn-primary">Submit</button>
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
          <h5 class="modal-title" id="exampleModalLabel">Edit Subcategory</h5>
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
	$(function childcategory(){
        var table =$('.ytable').DataTable({
            processing: true,
            serverSide: true,
            ajax:"{{route('childcategory.index')}}",
            coloumns:[
                {data:'DT_RowIndex',name:'DT_RowIndex'},
				{data:'childcategory_name'  ,name:'childcategory_name'},
				{data:'category_name',name:'category_name'},
				{data:'subcategory_name',name:'subcategory_name'},
				{data:'action',name:'action',orderable:true, searchable:true},
            ]
        });
    });
   
</script>


@endsection
