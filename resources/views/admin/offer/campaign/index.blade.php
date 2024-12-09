@extends('layouts.admin')

@section('admin_content')
<div class="page-wrapper">			
    <div class="content container-fluid">        
        @include('layouts.admin_partial.page_header')

        <div class="row">
            <div class="col-sm-12">
                <div class="card shadow">
                    <div class="card-header text-center">
                        <h3 class="card-title btn btn-secondary btn-lg">All Campaign list here</h3>
                        <button class="btn btn-danger btn-lg" data-toggle="modal" data-target="#campaignModal"> <i class="fa fa-plus"></i> Add New Campaign</button>
                    </div>
                    <div class="card-body">
                        <span style="text-align:center">@include('validate')</span>
                        <div class="table-responsive">
                            <table class="table mb-0 data-table-said table-bordered table-primary table-sm ytable">
                                <thead>
                                    <tr>
                                        <th>SL</th>
                                        <th>Start Date</th>
                                        <th>Title</th>
                                        <th>Image</th>
                                        <th>Discount(%)</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    
                                    
                                </tbody>
                            </table>
                            <form id="product_delete_form" action="" method="post">
                                @method('DELETE')
                                @csrf
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>     

    </div>			
</div>

{{-- brand insert modal --}}
<div class="modal fade" id="campaignModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Add New Campaign</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="{{route('campaign.store')}}" id="add_form" method="Post" enctype="multipart/form-data">
            @csrf
            <div class="modal-body">
                <div class="form-group">
                    <label for="brand_name">Title</label>
                    <input type="text" class="form-control" id="title" name="title" required="">
                    <small id="emailHelp" class="form-text text-muted">This is your main title</small>
                </div> 
                <div class="form-group font-weight-bold form-border">
                    <div class="row">
                     <div class="col-md-6">
                         <label>Start Date</label> <br>
                         <input name="start_date" type="date" class="form-control">
                     </div>
                     <div class="col-md-6">
                         <label>End Date</label> <br>
                         <input name="end_date" type="date" class="form-control">
                     </div>
                     </div>                                       
                 </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-6">
                            <label for="brand_name">Status</label>
                            <select name="status" class="form-control">
                                <option value="1">Active</option>
                                <option value="0">Inactive</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="brand_name">Discount</label>
                            <input type="number" class="form-control" id="title" name="discount" required="">
                            <small id="emailHelp" class="form-text text-muted">This is your discount</small>
                        </div>
                    </div>                   
                </div> 
                <div class="form-group">
                    <label for="image">Camapign Image</label>
                    <input name="image" type="file" class="dropify" data-height="140">
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
          <h5 class="modal-title" id="exampleModalLabel">Edit Campaign</h5>
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

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

<script type="text/javascript">


$(function campaign(){
        table=$('.ytable').DataTable({
        processing:true,
        serverSide:true,
        ajax:"{{ route('campaign.index') }}",
        columns:[
            {data:'DT_RowIndex',name:'DT_RowIndex'},
            {data:'start_date'  ,name:'start_date'},
            {data:'title',name:'title'},
            {data:'image',name:'image'},
            {data:'discount',name:'discount'},
            {data:'status',name:'status'},
            {data:'action',name:'action',orderable:true, searchable:true},

        ]
    });
});

$('body').on('click', '.edit', function(){
    let campaign_id =$(this).data('id');
    $.get('campaign/edit/'+campaign_id, function(data){
        $('#modal_body').html(data);
        
    });
});


$(document).ready(function(){
    // Product Data Deleted
    $(document).on('click', '#product_delete', function(e){
        e.preventDefault();
        let url=$(this).attr('href');
        $('#product_delete_form').attr('action',url);

        swal({
                title: "Are you sure?",
                text: "Once deleted, you will not be able to recover this imaginary file!",
                icon: "warning",
                buttons: true,
                dangerMode: true,
        })
        .then((willDelete) => {
            if (willDelete) {
                $('#product_delete_form').submit();
            }else{
                swal({
                    title:"Save Data",
                    icon:"success"
                })
            }
        });

    });

    // Product Data Deleted Form
    $('#product_delete_form').submit(function(e){
        e.preventDefault();
        let url=$(this).attr('action');
        let request=$(this).serialize();
        $.ajax({
            url:url,
            type:'post',
            async:false,
            data:request,
            success:function(data){
                toastr.success(data);
                $('#product_delete_form')[0].reset();
                table.ajax.reload();
            }
        });

    });

    });

</script>


@endsection
