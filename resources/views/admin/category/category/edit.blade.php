<form action="{{route('category.update')}}" method="Post" enctype="multipart/form-data">
    @csrf
    <div class="modal-body">
        <div class="form-group">
        <label>Category Name</label>
        <input  name="category_name" value="{{$edit->category_name}}" type="text" class="form-control" required="">
        <small id="emailHelp" class="form-text text-muted">This is your main category</small>
        </div> 
        <input type="hidden" name="id" value="{{$edit->id}}">
        <div class="form-group">
            <label>Old Category Icon</label>
            <img class="img-thumbnail" src="{{url('storage/categories/' .$edit -> icon)}}" alt="{{ $edit -> category_name }}" width="40" height="40">
        </div>  
        <div class="form-group">
            <label>New Category Icon</label>
            <input name="icon" type="file" class="dropify">
            <input type="hidden" name="old_icon" value="{{$edit->icon}}">
        </div>  
        <div class="form-group">
        <label for="category_name">Show on Homepage</label>
        <select name="home_page" class="form-control">
            <option value="1" @if($edit->home_page==1) selected @endif>Yes</option>
            <option value="0" @if($edit->home_page==0) selected @endif>No</option>
        </select>
        <small id="emailHelp" class="form-text text-muted">If yes it will be show on your home page</small>
        </div>
    </div>
    <div class="modal-footer">
    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
    <button type="Submit" class="btn btn-success">Update</button>
    </div>
</form>


<script type="text/javascript" src="https://jeremyfagis.github.io/dropify/dist/js/dropify.min.js"></script>
<script>
    $('.dropify').dropify();
</script>