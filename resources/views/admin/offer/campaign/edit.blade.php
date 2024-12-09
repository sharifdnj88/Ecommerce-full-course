<form action="{{route('campaign.update')}}" id="add_form" method="Post" enctype="multipart/form-data">
    @csrf
    <div class="modal-body">
        <div class="form-group">
            <label for="brand_name">Title</label>
            <input name="title" type="text" value="{{$edit->title}}" class="form-control" id="title" required="">
            <small id="emailHelp" class="form-text text-muted">This is your main title</small>
        </div> 
        <input type="hidden" name="id" value="{{$edit->id}}">
        <div class="form-group font-weight-bold form-border">
            <div class="row">
             <div class="col-md-6">
                 <label>Start Date</label> <br>
                 <input name="start_date" value="{{$edit->start_date}}" type="date" class="form-control">
             </div>
             <div class="col-md-6">
                 <label>End Date</label> <br>
                 <input name="end_date" value="{{$edit->end_date}}" type="date" class="form-control">
             </div>
             </div>                                       
         </div>
        <div class="form-group">
            <div class="row">
                <div class="col-md-6">
                    <label for="brand_name">Status</label>
                    <select name="status" class="form-control">
                        <option value="1" @if($edit->status==1) selected @endif >Active</option>
                        <option value="0" @if($edit->status==0) selected @endif>Inactive</option>
                    </select>
                </div>
                <div class="col-md-6">
                    <label for="brand_name">Discount</label>
                    <input type="number" value="{{$edit->discount}}" class="form-control" id="title" name="discount" required="">
                    <small id="emailHelp" class="form-text text-muted">This is your discount</small>
                </div>
            </div>                   
        </div> 
        <div class="form-group">
            <label for="brand-name">Old Campaign Image</label>
            <a href="{{url('storage/campaigns/' .$edit -> image)}}" target="_blank">
                <img class="img-thumbnail" src="{{url('storage/campaigns/' .$edit -> image)}}" alt="" width="100%" height="120">
            </a>
          </div>   
          <hr>                         
        <div class="form-group">
            <label for="image">New Camapign Image</label>
            <input name="image" type="file" class="dropify" data-height="140">
            <input type="hidden" name="old_image" value="{{$edit->image}}">
        </div>                              
    </div>
    <div class="modal-footer">
    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
    <button type="Submit" class="btn btn-success">Update</button>
    </div>
</form>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<script>
    $('.dropify').dropify();
</script>