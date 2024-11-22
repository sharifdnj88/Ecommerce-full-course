@extends('layouts.admin')

@section('admin_content')
<div class="page-wrapper">			
    <div class="content container-fluid">        
        @include('layouts.admin_partial.page_header')

        <div class="row">
            <div class="col-sm-12">
                <div class="card shadow-lg">
                    <div class="card-header text-center">
                        <h3 class="card-title btn btn-secondary btn-lg">All Product list here</h3>
                        <a href="{{route('product.create')}}" class="btn btn-danger btn-lg"> <i class="fa fa-plus"></i> Create Product</a>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group font-weight-bold">
                                    <label>Category Name</label>
                                    <select name="category_id" id="category_id" class="form-control submitable">
                                        <option value="">ALL</option>
                                        @foreach ($category as $item)
                                            <option value="{{$item->id}}">{{$item->category_name}}</option>                                        
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group font-weight-bold">
                                    <label>Brand Name</label>
                                    <select name="brand_id" id="brand_id" class="form-control submitable">
                                        <option value="">ALL</option>
                                        @foreach ($brand as $item)
                                            <option value="{{$item->id}}">{{$item->brand_name}}</option>                                        
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group font-weight-bold">
                                    <label>warehouse Name</label>
                                    <select name="warehouse" id="warehouse" class="form-control submitable">
                                        <option value="">ALL</option>
                                        @foreach ($warehouse as $item)
                                            <option value="{{$item->id}}">{{$item->warehouse_name}}</option>                                        
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group font-weight-bold">
                                    <label>Status</label>
                                    <select name="status" id="status" class="form-control submitable">
                                        <option value="1,0">ALL</option>
                                        <option value="1">Active</option>
                                        <option value="0">Inactive</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <span style="text-align:center">@include('validate')</span>
                        <div class="table-responsive">
                            <table class="table mb-0 data-table-said table-bordered table-primary table-sm brand-table ytable">
                                <thead>
                                    <tr>
                                        <th>SL</th>
                                        <th>Thumbnail</th>
                                        <th>Name</th>
                                        <th>Code</th>
                                        <th>Category</th>
                                        <th>subcategory</th>
                                        <th>Brand</th>
                                        <th>Featured</th>
                                        <th>Today Deal</th>
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




<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<script type="text/javascript">



    $(function product(){
              table=$('.ytable').DataTable({
                "processing":true,
                "serverSide":true,
                "searching":true,
                "ajax":{
                    "url": "{{ route('product.index') }}", 
                    "data":function(e) {
                    e.category_id =$("#category_id").val();
                    e.brand_id =$("#brand_id").val();
                    e.warehouse =$("#warehouse").val();
                    e.status =$("#status").val();
                    }
                },
                columns:[
                    {data:'DT_RowIndex',name:'DT_RowIndex'},
                    {data:'thumbnail',name:'thumbnail'},
                    {data:'name',name:'name'},
                    {data:'code',name:'code'},
                    {data:'category_name',name:'category_name'},
                    {data:'subcategory_name',name:'subcategory_name'},
                    {data:'brand_name',name:'brand_name'},
                    {data:'featured',name:'featured'},
                    {data:'today_deal',name:'today_deal'},
                    {data:'status',name:'status'},
                    {data:'action',name:'action',orderable:true, searchable:true},
    
                ]
            });
        });


    // Product Featured Deactive 
    $('body').on('click','.featured_deactive', function(){
        let id =$(this).data('id');
        let url="{{url('product/featured-deactive')}}/"+id;
        $.ajax({
            url:url,
            type:'get',
            success:function(data){
                toastr.success(data);
                table.ajax.reload();
            }
        })
    });

    // Product Featured Active 
    $('body').on('click', '.featured_active', function(){
        let id=$(this).data('id');
        let url="{{url('product/featured-active')}}/"+id;
        $.ajax({
            url:url,
            type:'get',
            success:function(data){
                toastr.success(data)
                table.ajax.reload();
            }
        });
    });

    // Product Today Deal Deactive
    $('body').on('click', '.today_deal_deactive', function(){
        let id=$(this).data('id');
        let url="{{url('product/today-deal-deactive')}}/"+id;
        $.ajax({
            url:url,
            type:'get',
            success:function(data){
                toastr.success(data);
                table.ajax.reload();
            }
        })
    });

    // Product Today Deal Active
    $('body').on('click', '.today_deal_active', function(){
        let id =$(this).data('id');
        let url="{{url('product/today-deal-active')}}/"+id;
        $.ajax({
            url:url,
            type:'get',
            success:function(data){
                toastr.success(data);
                table.ajax.reload();
            }
        });
    });

    // Product Status Deactive
    $('body').on('click', '.status_deactive', function(){
        let id=$(this).data('id');
        let url="{{url('product/status-deactive')}}/"+id;
        $.ajax({
            url:url,
            type:'get',
            success:function(data){
                toastr.success(data);
                table.ajax.reload();
            }
        });
    });

    // Product Status Active
    $('body').on('click', '.status_active', function(){
        let id=$(this).data('id');
        let url="{{url('product/status-active')}}/"+id;
        $.ajax({
            url:url,
            type:'get',
            success:function(data){
                toastr.success(data);
                table.ajax.reload();
            }
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

    $(document).on('change', '.submitable', function(){
        $('.ytable').DataTable().ajax.reload();
    });


        

</script>



@endsection
