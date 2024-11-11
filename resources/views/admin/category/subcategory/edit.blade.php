<form action="{{route('subcategory.update')}}" method="Post">
    @csrf
    <div class="modal-body">
        <div class="form-group">
            <label for="category_id">Category Name</label>
            <select name="category_id" class="form-control" id="" required>
                @foreach ($category as $cat)
                    <option value="{{$cat->id}}" @if($cat->id==$data->category_id) selected @endif>{{$cat->category_name}}</option>                    
                @endforeach
                <input type="hidden" class="form-control" name="id" value="{{$data->id}}">
            </select>
            </div> 
            <div class="form-group">
            <label for="subcategory_name">Subcategory Name</label>
            <input type="text" class="form-control" id="subcategory_name" name="subcategory_name" value="{{$data->subcategory_name}}" required="">
            <small id="emailHelp" class="form-text text-muted">This is your main subcategory</small>
            </div> 
    </div>
    <div class="modal-footer">
    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
    <button type="Submit" class="btn btn-primary">Update</button>
    </div>
</form>