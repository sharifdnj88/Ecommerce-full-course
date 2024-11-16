@extends('layouts.admin')

@section('admin_content')
<div class="page-wrapper">			
    <div class="content container-fluid">        
        @include('layouts.admin_partial.page_header')

        <div class="row">
            <div class="col-sm-12">
                <div class="card shadow">
                    <div class="card-header text-center">
                        <h3 class="card-title btn btn-secondary btn-lg">All Warehouse list here</h3>
                        <button class="btn btn-danger btn-lg" data-toggle="modal" data-target="#warehouseModal"> <i class="fa fa-plus"></i> Add New Warehouse</button>
                    </div>
                    <div class="card-body">
                        <span style="text-align:center">@include('validate')</span>
                        <div class="table-responsive">
                            <table class="table mb-0 data-table-said table-bordered table-primary table-sm">
                                <thead>
                                    <tr>
                                        <th>SL</th>
                                        <th>Warehouse Name</th>
                                        <th>Warehouse Phone</th>
                                        <th>Warehouse Address</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($warehouse as $item)
                                        <tr>
                                            <td>{{$loop-> index  + 1}}</td>
                                            <td>{{ $item -> warehouse_name }}</td>
                                            <td>{{ $item -> warehouse_phone }}</td>                                            
                                            <td>{!! Str::of( htmlspecialchars_decode( $item -> warehouse_address ) ) -> words(20, '...') !!}</td>                                            
                                            <td>
                                                <a href="#" class="btn btn-sm btn-warning edit" data-id="{{ $item->id }}" data-toggle="modal" data-target="#editModal" ><i class="fa fa-edit" ></i></a>                                                
                                                <a href="{{route('warehouse.delete', $item->id)}}" class="btn btn-sm btn-danger" id="delete" ><i class="fa fa-trash" ></i></a>
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
<div class="modal fade" id="warehouseModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Add New Warehouse</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="{{route('warehouse.store')}}" id="add-form" method="Post">
            @csrf
            <div class="modal-body">
                <div class="form-group">
                    <label for="warehouse_name">Warehouse Name</label>
                    <input name="warehouse_name" type="text" class="form-control" id="warehouse_name" required="">
                    <small id="emailHelp" class="form-text text-muted">This is your main warehouse</small>
                </div>                 
                <div class="form-group">
                    <label for="warehouse_phone">Warehouse Phone</label>
                    <input name="warehouse_phone" type="text" class="form-control" id="warehouse_phone" required="">
                    <small id="emailHelp" class="form-text text-muted">This is your main phone</small>
                </div>                 
                <div class="form-group">
                    <label for="warehouse_address">Warehouse Address</label>
                    <textarea name="warehouse_address" class="form-control textarea"></textarea>                    
                    <small id="emailHelp" class="form-text text-muted">This is your main address</small>
                </div>                 
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            <button type="Submit" class="btn btn-success"> <span class="d-none loader"><i class="fa fa-spinner"></i> Loading...</span> <span class="submit_btn"> Submit </span> </button>
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
          <h5 class="modal-title" id="exampleModalLabel">Edit Warehouse</h5>
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
        let warehouse_id =$(this).data('id');
        $.get('warehouse/edit/'+warehouse_id, function(data){
            $('#modal_body').html(data);
            
        });
    });

    $('#add-form').on('submit', function(){
        $('.loader').removeClass('d-none');
        $('.submit_btn').addClass('d-none');
    });
    

</script>


@endsection
