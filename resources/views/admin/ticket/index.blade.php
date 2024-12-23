@extends('layouts.admin')

@section('admin_content')
<div class="page-wrapper">			
    <div class="content container-fluid">        
        @include('layouts.admin_partial.page_header')

        <div class="row">
            <div class="col-sm-12">
                <div class="card shadow-lg">
                    <div class="card-header text-center">
                        <h3 class="card-title btn btn-secondary btn-lg">All Ticket list</h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group font-weight-bold">
                                    <label>Ticket Type</label>
                                    <select class="form-control submitable" name="type" id="type">
                                        <option value="">All</option>
                                        <option value="Technical">Technical</option>
                                          <option value="Payment">Payment</option>
                                          <option value="Affiliate">Affiliate</option>
                                          <option value="Return">Return</option>
                                          <option value="Refund">Refund</option> 
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group font-weight-bold">
                                    <label>Status</label>
                                    <select class="form-control submitable" name="status" id="status">
                                            <option value="0,1,2">All</option>
                                            <option value="0">Pending</option>
                                            <option value="1">Replied</option>
                                            <option value="2">Closed</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group font-weight-bold">
                                    <label>Date</label>
              		                <input type="date" name="date" id="date" class="form-control submitable_input">
                                </div>
                            </div>
                        </div>
                        <span style="text-align:center">@include('validate')</span>
                        <div class="table-responsive">
                            <table class="table mb-0 data-table-said table-bordered table-primary table-sm brand-table ytable">
                                <thead>
                                    <tr>
                                        <th>SL</th>
                                        <th>User</th>
                                        <th>Subject</th>
                                        <th>Service</th>
                                        <th>Priority</th>
                                        <th>Date</th>
                                        <th>Status</th>
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




<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<script type="text/javascript">
	$(function products(){
		table=$('.ytable').DataTable({
			"processing":true,
		      "serverSide":true,
		      "searching":true,
		      "ajax":{
		        "url": "{{ route('ticket.index') }}", 
		        "data":function(e) {
		          e.type =$("#type").val();
		          e.status =$("#status").val();
		          e.date =$("#date").val();
		        }
		      },
			columns:[
				{data:'DT_RowIndex',name:'DT_RowIndex'},
				{data:'name'  ,name:'name'},
				{data:'subject'  ,name:'subject'},
				{data:'service'  ,name:'service'},
				{data:'priority',name:'priority'},
				{data:'date',name:'date'},
				{data:'status',name:'status'},
				{data:'action',name:'action',orderable:true, searchable:true},
			]
		});
	});


    $(document).ready(function(){
	      $(document).on('click', '#delete_ticket',function(e){
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
                 swal("Your imaginary file is safe!");
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

  



	//submitable class call for every change
  $(document).on('change','.submitable', function(){
    $('.ytable').DataTable().ajax.reload();
  });

  $(document).on('change','.submitable_input', function(){
    $('.ytable').DataTable().ajax.reload();
  });

</script>



@endsection
