@extends('layouts.admin')

@section('admin_content')
<style type="text/css">
  .bootstrap-tagsinput .tag {
    background: #131039;
    border: 1px solid white;
    padding: 2px 8px;
    color: white;
    border-radius: 4px;    
  }
  .bootstrap-tagsinput{
    width: 100%!important;
  }
  .btn_remove{
    width: 100%!important;
  }
</style>
<div class="page-wrapper">			
    <div class="content container-fluid">        
        @include('layouts.admin_partial.page_header')

        <div class="row">
            <div class="col-md-12">
                <div class="card shadow-lg">
                    <div class="card-header btn btn-secondary">
                        <h4 class="card-title">Update Product</h4>
                    </div>
                    <div class="card-body">
                        <span style="text-align:center">@include('validate')</span>
                        <form action="#" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-md-8">
                                    {{-- Second Row --}}
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group font-weight-bold">
                                                <label>Product Name <span class="text-danger">*</span> </label>
                                                <input name="name" type="text" value="{{ $edit->name }}" class="form-control">
                                            </div>
                                            <div class="form-group font-weight-bold">
                                                <label>Category/Subcategory <span class="text-danger">*</span> </label>
                                                <select name="subcategory_id" id="subcategory_id" class="form-control">
                                                    <option disabled="" selected="">--choose category--</option>
                                                    @foreach($category as $item)
                                                    @php 
                                                        $subcategory=DB::table('subcategories')->where('category_id',$item->id)->get();
                                                    @endphp
                                                    <option style="color:blue;" disabled="">{{ $item->category_name }}</option>
                                                        @foreach($subcategory as $item)
                                                        <option value="{{ $item->id }}" @if($item->id == $edit->subcategory_id) selected @endif> -- {{ $item->subcategory_name }}</option>
                                                        @endforeach
                                                @endforeach 
                                                </select>
                                            </div>
                                            <div class="form-group font-weight-bold">
                                                <label>Pickup Point <span class="text-danger">*</span> </label>
                                                <select name="pickup_point_id" class="form-control">
                                                    <option>--Choose Pickup Point--</option>
                                                    @foreach ($pickup_point as $item)
                                                        <option value="{{$item->id}}" @if($item->id == $edit->pickup_point_id) selected @endif>{{$item->pickup_point_name}}</option>
                                                        
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="form-group font-weight-bold">
                                                <label>Stock <span class="text-danger">*</span> </label>
                                                <input name="stock_quantity" type="text" value="{{ $edit->stock_quantity }}" class="form-control">
                                            </div>    
                                            
                                            
                                            <div class="form-group font-weight-bold">
                                                <label>Purchase Price <span class="text-danger">*</span> </label>
                                                <input name="purchase_price" type="text" value="{{ $edit->purchase_price }}" class="form-control">
                                            </div>                                      
                                        
                                            <div class="form-group font-weight-bold">
                                                <label>Warehouse <span class="text-danger">*</span> </label>
                                                <select name="warehouse" class="form-control">
                                                    <option>--Select--</option>
                                                    @foreach ($warehouse as $item)
                                                        <option value="{{$item->id}}" @if($item->id == $edit->warehouse) selected @endif>{{$item->warehouse_name}}</option>                                                        
                                                    @endforeach
                                                </select>
                                            </div>
                                        
                                            <div class="form-group font-weight-bold">
                                                <label>Color <span class="text-danger">*</span> </label><br>
                                                <input name="color" type="text" value="{{ $edit->color }}" class="form-control" data-role="tagsinput">
                                            </div>                                       
                                           
                                         

                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group font-weight-bold">
                                                <label>Brand Name <span class="text-danger">*</span> </label>
                                                <select name="brand_id" class="form-control">
                                                    @foreach ($brand as $item)
                                                        <option value="{{$item->id}}" @if($item->id == $edit->brand_id) selected @endif>{{$item->brand_name}}</option>                                                        
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="form-group font-weight-bold">
                                                <label>Childcategory <span class="text-danger">*</span> </label>
                                                <select name="childcategory_id" id="childcategory_id" class="form-control">
                                                    @foreach ($childcategory as $item)
                                                        <option value="{{$item->id}}"  @if($item->id == $edit->childcategory_id) selected @endif>{{$item->childcategory_name}}</option>                                                        
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="form-group font-weight-bold">
                                                <label>Unit <span class="text-danger">*</span> </label>
                                                <input name="unit" type="text" value="{{ $edit->unit }}" class="form-control">
                                            </div>                                            
                                            <div class="form-group font-weight-bold">
                                                <label>Discount Price</label>
                                                <input name="discount_price" type="text" value="{{ $edit->discount_price }}" class="form-control">
                                            </div>
                                            <div class="form-group font-weight-bold">
                                                <label>Selling Price <span class="text-danger">*</span> </label>
                                                <input name="selling_price" type="text" value="{{ $edit->selling_price }}" class="form-control" required>
                                            </div>
                                            
                                            <div class="form-group font-weight-bold">
                                                <label>Tags <span class="text-danger">*</span> </label> <br>
                                                <input name="tags" type="text" value="{{ $edit->tags }}" class="form-control" data-role="tagsinput">
                                            </div>
                                            <div class="form-group font-weight-bold">
                                                <label>Size <span class="text-danger">*</span> </label> <br>
                                                <input name="size" type="text" value="{{ $edit->size }}" class="form-control" data-role="tagsinput">
                                            </div>

                                        </div>
                                    </div>
                                    {{-- Second Row --}}

                                   
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group font-weight-bold">
                                        <label>Main Thumbnail <span class="text-danger">*</span> </label>
                                        <input name="thumbnail" type="file" class="form-control dropify">
                                    </div>                                    
                                    <div class="form-group font-weight-bold">  
                                        <table class="table table-bordered" id="dynamic_field">
                                        <div class="card-header">
                                          <p class="card-title">More Images (Click Add For More Image)</p>
                                        </div> 
                                          <tr>  
                                              <td><input type="file" accept="image/*" name="images[]" class="form-control name_list" /></td>  
                                              <td><button type="button" name="add" id="add" class="btn btn-success">Add</button></td>  
                                          </tr>  
                                        </table>    
                                      </div>
                                      <div class="form-group font-weight-bold form-border">
                                        <label>Featured Product</label> <br>                                        
                                        <input type="checkbox" name="featured" value="1" @if($edit->featured == 1) checked @endif data-bootstrap-switch data-off-color="danger" data-on-color="success">
                                    </div>
                                    <div class="form-group font-weight-bold form-border">
                                        <label>Today Deal</label> <br>
                                        <input type="checkbox" name="today_deal" value="1" @if($edit->today_deal == 1) checked @endif data-bootstrap-switch data-off-color="danger" data-on-color="success">                                        
                                    </div>
                                    <div class="form-group font-weight-bold form-border">
                                        <label>Product Slider</label> <br>
                                        <input type="checkbox" name="product_slider" value="1" @if($edit->product_slider == 1) checked @endif data-bootstrap-switch data-off-color="danger" data-on-color="success">                                        
                                    </div>
                                    <div class="form-group font-weight-bold form-border">
                                        <label>Status</label> <br>
                                        <input type="checkbox" name="status" value="1" @if($edit->status == 1) checked @endif data-bootstrap-switch data-off-color="danger" data-on-color="success">                                        
                                    </div>
                                </div>
                            </div>                            
                           
                            <div class="row">
                                <div class="col-md-8">
                                    <div class="form-group font-weight-bold p_details" style="margin-top: -200px">
                                        <label>Product Details <span class="text-danger">*</span> </label>
                                        <textarea name="description" class="form-control textarea">{{ $edit->description }}</textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-8">
                                    <div class="form-group font-weight-bold">
                                        <label>Video Embed Code</label>
                                        <input name="video" type="text" value="{{ $edit->video }}" class="form-control">
                                    </div>
                                </div>
                            </div>                                                  

                            <div class="text-right">
                                <button type="submit" class="btn btn-success">Update</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="{{asset('backend/plugins/bootstrap-switch/js/bootstrap-switch.min.js')}}"></script>



<script type="text/javascript">

$("input[data-bootstrap-switch]").each(function(){
      $(this).bootstrapSwitch('state', $(this).prop('checked'));
});

 //ajax request send for collect childcategory
 $("#subcategory_id").change(function(){
        var id = $(this).val();
        $.ajax({
             url: "{{ url("/get-child-category/") }}/"+id,
             type: 'get',
             success: function(data) {
                  $('select[name="childcategory_id"]').empty();
                     $.each(data, function(key,data){
                        $('select[name="childcategory_id"]').append('<option value="'+ data.id +'">'+ data.childcategory_name +'</option>');
                  });
             }
          });
       });       
  


$(document).ready(function(){      
         var postURL = "<?php echo url('addmore'); ?>";
         var i=1;  
  
  
         $('#add').click(function(){  
              i++;  
              $('#dynamic_field').append('<tr id="row'+i+'" class="dynamic-added"><td><input type="file" accept="image/*" name="images[]" class="form-control name_list" /></td><td><button type="button" name="remove" id="'+i+'" class="btn btn-danger btn_remove">X</button></td></tr>');  
         });  
  
         $(document).on('click', '.btn_remove', function(){  
              var button_id = $(this).attr("id");   
              $('#row'+button_id+'').remove();  
         });  
       });  
  
  
  </script>

@endsection