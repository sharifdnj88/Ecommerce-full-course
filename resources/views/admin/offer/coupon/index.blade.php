@extends('layouts.admin')

@section('admin_content')
<div class="page-wrapper">			
    <div class="content container-fluid">        
        @include('layouts.admin_partial.page_header')

        <div class="row">
            <div class="col-sm-12">
                <div class="card shadow">
                    <div class="card-header text-center">
                        <h3 class="card-title btn btn-secondary btn-lg">All Coupon list here</h3>
                        <button class="btn btn-danger btn-lg" data-toggle="modal" data-target="#addModal"> <i class="fa fa-plus"></i> Add New Coupon</button>
                    </div>
                    <div class="card-body">
                        <span style="text-align:center">@include('validate')</span>
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-hover table-bordered table-sm ytable">
                                <thead>
                                <tr>
                                  <th>SL</th>
                                  <th>Coupon Code</th>
                                  <th>Coupon Amount</th>
                                  <th>Coupon Date</th>
                                  <th>Coupon Status</th>
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

{{-- Coupon insert modal --}}
<div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Add New Coupon</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="{{route('coupon.store')}}" id="add_form" method="Post">
            @csrf
            <div class="modal-body">
                <div class="form-group">
                    <label for="status">Coupon Status</label>
                    <select name="status" class="form-control">
                        <option value="Active">Active</option>
                        <option value="Inactive">Inactive</option>
                    </select>
                    <small id="emailHelp" class="form-text text-muted">This is your coupon status</small>
                </div> 
                <div class="form-group">
                    <label for="type">Coupon Type</label>
                    <select name="type" class="form-control">
                        <option value="1">Fixed</option>
                        <option value="2">Percentage</option>
                    </select>
                    <small id="emailHelp" class="form-text text-muted">This is your coupon type</small>
                </div>                 
                <div class="form-group">
                    <label for="valid_date">Coupon Date</label>
                    <input name="valid_date" type="date" class="form-control" id="valid_date" required="">
                    <small id="emailHelp" class="form-text text-muted">This is your coupon date</small>
                </div>                                
                <div class="form-group">
                    <label for="coupon_code">Coupon Code</label>
                    <input name="coupon_code" type="text" class="form-control" id="coupon_code" required="">
                    <small id="emailHelp" class="form-text text-muted">This is your coupon code</small>
                </div>                 
                <div class="form-group">
                    <label for="coupon_amount">Coupon Amount</label>
                    <input name="coupon_amount" type="text" class="form-control" id="coupon_amount" required="">                   
                    <small id="emailHelp" class="form-text text-muted">This is your main address</small>
                </div>                 
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            <button type="Submit" class="btn btn-success"> <span class="d-none loader"><i class="fa fa-spinner"></i> loader...</span> <span class="submit_btn"> Submit </span> </button>
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
          <h5 class="modal-title" id="exampleModalLabel">Edit Coupon</h5>
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
			ajax:"{{ route('coupon.index') }}",
			columns:[
				{data:'DT_RowIndex',name:'DT_RowIndex'},
				{data:'coupon_code'  ,name:'coupon_code'},
				{data:'coupon_amount',name:'coupon_amount'},
				{data:'valid_date',name:'valid_date'},
				{data:'status',name:'status'},
				{data:'action',name:'action',orderable:true, searchable:true},

			]
		});
	});

  //store coupon ajax call
  $('#add_form').submit(function(e){
    e.preventDefault();
    $('.loader').removeClass('d-none');
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
        $('.loader').addClass('d-none');
        $('#addModal').modal('hide');
        table.ajax.reload();
      }
    });
  });  

 

  $('body').on('click','.edit', function(){
    let id=$(this).data('id');
    $.get("coupon/edit/"+id, function(data){
      $("#modal_body").html(data);
    });
  });



//   Coupon delete
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
