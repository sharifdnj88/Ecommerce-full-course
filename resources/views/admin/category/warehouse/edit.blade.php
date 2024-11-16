<link rel="stylesheet" href="{{ asset('backend/plugins/summernote/summernote-bs4.css') }}">
<form action="{{route('warehouse.update')}}" method="Post" id="add-form">
    @csrf
    <div class="modal-body">
        <div class="form-group">
            <label for="warehouse_name">Warehouse Name</label>
            <input name="warehouse_name" value="{{$edit->warehouse_name}}" type="text" class="form-control" id="warehouse_name" required="">
            <small id="emailHelp" class="form-text text-muted">This is your main warehouse</small>
        </div>  
        <input name="id" value="{{$edit->id}}" type="hidden">               
        <div class="form-group">
            <label for="warehouse_phone">Warehouse Phone</label>
            <input name="warehouse_phone" value="{{$edit->warehouse_phone}}" type="text" class="form-control" id="warehouse_phone" required="">
            <small id="emailHelp" class="form-text text-muted">This is your main phone</small>
        </div>                 
        <div class="form-group">
            <label for="warehouse_address">Warehouse Address</label>
            <textarea name="warehouse_address" value="{{$edit->warehouse_address}}" class="form-control textarea">{{$edit->warehouse_address}}</textarea>                    
            <small id="emailHelp" class="form-text text-muted">This is your main address</small>
        </div>                 
    </div>
    <div class="modal-footer">
    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
    <button type="Submit" class="btn btn-success"><span class="d-none loader"><i class="fa fa-spinner"></i> Loading...</span> <span class="submit_btn"> Update </span></button>
    </div>
</form>


<script src="{{ asset('backend/plugins/summernote/summernote-bs4.min.js') }}"></script>
<script>
    $(function () {
        // Summernote
        $('.textarea').summernote()
    });
</script>



