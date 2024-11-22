<form action="{{route('pickup.point.update')}}" id="edit_form" method="Post">
    @csrf
    <div class="modal-body">
        <div class="form-group">
            <label for="pickup_point_name">Pickpoint Name</label>
            <input name="pickup_point_name" value="{{$edit->pickup_point_name}}" type="text" class="form-control" id="pickup_point_name" required="">
            <small id="emailHelp" class="form-text text-muted">This is your pickup point name</small>
        </div>  
        <input name="id" value="{{$edit->id}}" type="hidden"> 
        <div class="form-group">
            <label for="pickup_point_address">Pickpoint Address</label>
            <input name="pickup_point_address" value="{{$edit->pickup_point_address}}" type="text" class="form-control" id="pickup_point_address" required="">
            <small id="emailHelp" class="form-text text-muted">This is your pickup point address</small>
        </div>   
        <div class="form-group">
            <label for="pickup_point_phone">Pickpoint Phone</label>
            <input name="pickup_point_phone" value="{{$edit->pickup_point_phone}}" type="text" class="form-control" id="pickup_point_phone" required="">
            <small id="emailHelp" class="form-text text-muted">This is your pickup point phone</small>
        </div>   
        <div class="form-group">
            <label for="pickup_point_phone_two">Pickpoint Another Phone</label>
            <input name="pickup_point_phone_two" value="{{$edit->pickup_point_phone_two}}" type="text" class="form-control" id="pickup_point_phone_two" required="">
            <small id="emailHelp" class="form-text text-muted">This is your pickup point another phone</small>
        </div>   
    </div>
    <div class="modal-footer">
    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
    <button type="submit" class="btn btn-success">Update</button>
    </div>
</form>


<script>
    //store coupon ajax call
    $('#edit_form').submit(function(e){
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
            $('#edit_form')[0].reset();
            $('#editModal').modal('hide');
            table.ajax.reload();
        }
        });
    });
</script>