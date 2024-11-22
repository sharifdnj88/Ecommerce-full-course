@extends('layouts.admin')

@section('admin_content')
<div class="page-wrapper">			
    <div class="content container-fluid">        
        @include('layouts.admin_partial.page_header')

        <div class="row">
            <div class="col-sm-12">
                <div class="card shadow">
                    <div class="card-header text-center">
                        <h3 class="card-title btn btn-secondary btn-lg">All Pickup-Point list here</h3>
                        <button class="btn btn-danger btn-lg" data-toggle="modal" data-target="#pickModal"> <i class="fa fa-plus"></i> Add New Pick-point</button>
                    </div>
                    <div class="card-body">
                        <span style="text-align:center">@include('validate')</span>
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-hover table-bordered table-sm ytable">
                                <thead>
                                <tr>
                                  <th>SL</th>
                                  <th>Name</th>
                                  <th>Address</th>
                                  <th>Phone</th>
                                  <th>Another Phone</th>
                                  <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
            
            
                                </tbody>
                              </table>
            
                              <form id="deleted_form" action="" method="post">
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

{{-- Pickup Point insert modal --}}
<div class="modal fade" id="pickModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Add New Pickup-Point</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="{{route('pickup.point.store')}}" id="add_form" method="Post">
            @csrf
            <div class="modal-body">
                <div class="form-group">
                    <label for="pickup_point_name">Pickpoint Name</label>
                    <input name="pickup_point_name" type="text" class="form-control" id="pickup_point_name" required="">
                    <small id="emailHelp" class="form-text text-muted">This is your pickup point name</small>
                </div>   
                <div class="form-group">
                    <label for="pickup_point_address">Pickpoint Address</label>
                    <input name="pickup_point_address" type="text" class="form-control" id="pickup_point_address" required="">
                    <small id="emailHelp" class="form-text text-muted">This is your pickup point address</small>
                </div>   
                <div class="form-group">
                    <label for="pickup_point_phone">Pickpoint Phone</label>
                    <input name="pickup_point_phone" type="text" class="form-control" id="pickup_point_phone" required="">
                    <small id="emailHelp" class="form-text text-muted">This is your pickup point phone</small>
                </div>   
                <div class="form-group">
                    <label for="pickup_point_phone_two"> Another Pickpoint Phone</label>
                    <input name="pickup_point_phone_two" type="text" class="form-control" id="pickup_point_phone_two" required="">
                    <small id="emailHelp" class="form-text text-muted">This is your pickup point another phone</small>
                </div>   
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-success">Submit</button>
            </div>
        </form>
      </div>
    </div>
</div>

{{-- edit modal --}}
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Edit Pickup Point</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
       <div id="modal_body">
        {{-- data came from admin.offer.coupon.edit --}}
       </div>
    </div>
</div>
</div>


<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<script type="text/javascript">

$(function coupon(){
		  table=$('.ytable').DataTable({
			processing:true,
			serverSide:true,
			ajax:"{{ route('pickup.point.index') }}",
			columns:[
				{data:'DT_RowIndex',name:'DT_RowIndex'},
				{data:'pickup_point_name'  ,name:'pickup_point_name'},
				{data:'pickup_point_address',name:'pickup_point_address'},
				{data:'pickup_point_phone',name:'pickup_point_phone'},
				{data:'pickup_point_phone_two',name:'pickup_point_phone_two'},
				{data:'action',name:'action',orderable:true, searchable:true},

			]
		});
	});

  //store coupon ajax call
  $('#add_form').submit(function(e){
    e.preventDefault();
    var url = $(this).attr('action');
    var request =$(this).serialize();
    $.ajax({
      url:url,
      type:'post',
      async:false,
      data:request,
      success:function(data){
        toastr.success(data);
        $('#add_form')[0].reset();
        $('#pickModal').modal('hide');
        table.ajax.reload();
      }
    });
  });  

 

  $('body').on('click','.edit', function(){
    let id=$(this).data('id');
    $.get("pickup-point/edit/"+id, function(data){
      $("#modal_body").html(data);
    });
  });



//   Pickup Point delete
  $(document).ready(function(){
	      $(document).on('click', '#delete_coupon',function(e){
            e.preventDefault();
            var url = $(this).attr('href');
            $("#deleted_form").attr('action',url);
            swal({
                title: "Are you sure?",
                text: "Once deleted, you will not be able to recover this imaginary file!",
                icon: "warning",
                buttons: true,
                dangerMode: true,
              })
              .then((willDelete) => {
              if (willDelete) {
                 $("#deleted_form").submit();
              } else {
                swal({
                    title: "Save Data",
                    icon: "success",
                })
              }
            });
         });

        //data passed through here
        $('#deleted_form').submit(function(e){
          e.preventDefault();
          var url = $(this).attr('action');
          var request =$(this).serialize();
          $.ajax({
            url:url,
            type:'post',
            async:false,
            data:request,
            success:function(data){
              toastr.success(data);
              $('#deleted_form')[0].reset();
               table.ajax.reload();
            }
          });
        });
    });

</script>


@endsection
