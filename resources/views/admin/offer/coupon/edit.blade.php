<form action="{{route('coupon.update')}}" id="edit_form" method="Post">
    @csrf
    <div class="modal-body">
        <div class="form-group">
            <label for="status">Coupon Status</label>
            <select name="status" class="form-control">
                <option value="Active" @if ($edit->status=="Active") selected @endif>Active</option>
                <option value="Inactive" @if ($edit->status=="Inactive") selected @endif>Inactive</option>
            </select>
            <small id="emailHelp" class="form-text text-muted">This is your coupon status</small>
        </div> 
        <input name="id" type="hidden" value="{{$edit->id}}">
        <div class="form-group">
            <label for="type">Coupon Type</label>
            <select name="type" class="form-control">
                <option value="1" @if ($edit->type=="1") selected @endif>Fixed</option>
                <option value="2" @if ($edit->type=="2") selected @endif>Percentage</option>
            </select>
            <small id="emailHelp" class="form-text text-muted">This is your coupon type</small>
        </div>                 
        <div class="form-group">
            <label for="valid_date">Coupon Date</label>
            <input name="valid_date" value="{{$edit->valid_date}}" type="date" class="form-control" id="valid_date" required="">
            <small id="emailHelp" class="form-text text-muted">This is your coupon date</small>
        </div>                                
        <div class="form-group">
            <label for="coupon_code">Coupon Code</label>
            <input name="coupon_code" value="{{$edit->coupon_code}}" type="text" class="form-control" id="coupon_code" required="">
            <small id="emailHelp" class="form-text text-muted">This is your coupon code</small>
        </div>                 
        <div class="form-group">
            <label for="coupon_amount">Coupon Amount</label>
            <input name="coupon_amount" value="{{$edit->coupon_amount}}" type="text" class="form-control" id="coupon_amount" required="">                   
            <small id="emailHelp" class="form-text text-muted">This is your main address</small>
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