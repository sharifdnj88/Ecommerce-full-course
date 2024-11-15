@extends('layouts.admin')

@section('admin_content')
<div class="page-wrapper">			
    <div class="content container-fluid">        
        @include('layouts.admin_partial.page_header')

        <div class="row">
            <div class="col-sm-12">
                <div class="card shadow">
                    <div class="card-header text-center">
                        <h3 class="card-title btn btn-secondary btn-lg">All Child-Categories list here</h3>
                        <button class="btn btn-danger btn-lg" data-toggle="modal" data-target="#childModal"> <i class="fa fa-plus"></i> Add New Subcategory</button>
                    </div>
                    <div class="card-body">
                      <span style="text-align:center">@include('validate')</span>
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
                                    @forelse ($data as $item)
                                    <tr>
                                        <td>{{$loop-> index  + 1}}</td>
                                        <td>{{ $item -> childcategory_name }}</td>
                                        <td>{{ $item -> category_name }}</td>
                                        <td>{{ $item -> subcategory_name }}</td>
                                        <td>
                                            <a href="#" class="btn btn-sm btn-warning edit" data-id="{{ $item->id }}" data-toggle="modal" data-target="#editModal" ><i class="fa fa-edit" ></i></a>                                                
                                            <a href="{{route('childcategory.delete', $item->id)}}" class="btn btn-sm btn-danger" id="delete" ><i class="fa fa-trash" ></i></a>
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
<div class="modal fade" id="childModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Add New Child Category</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
       <form action="{{ route('childcategory.store') }}" method="Post" id="add-form">
        @csrf
        <div class="modal-body">
              <div class="form-group">
              <label for="category_name">Category/Subcategory </label>
              <select class="form-control" name="subcategory_id" required="">
                  @foreach($category as $cat)
                    @php 
                      $subcat=DB::table('subcategories')->where('category_id',$cat->id)->get();
                    @endphp
                    <option disabled="" style="color: blue;"
                    >{{ $cat->category_name }}</option>
                    @foreach($subcat as $scat)
                          <option value="{{ $scat->id }}"> ---- {{ $scat->subcategory_name }}</option>
                    @endforeach    
                  @endforeach
              </select>
            </div>
            <div class="form-group">
              <label for="category_name">Child Category Name</label>
              <input type="text" class="form-control"  name="childcategory_name" required="">
              <small id="emailHelp" class="form-text text-muted">This is your childcategory category</small>
            </div>   
        </div>
        <div class="modal-footer">
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
	$('body').on('click', '.edit', function(){
        let child_id =$(this).data('id');
        $.get('childcategory/edit/'+child_id, function(data){
            $('#modal_body').html(data);
            
        });
    });

</script>
@endsection
