<form action="{{ route('childcategory.update') }}" method="Post">
    @csrf
    <div class="modal-body">
          <div class="form-group">
          <label for="category_name">Category/Subcategory </label>
          <select class="form-control" name="subcategory_id" required="">
            @foreach($category as $cat)
            @php 
              $subcat=DB::table('subcategories')->where('category_id',$cat->id)->get();
            @endphp
            <option disabled="" style="color: blue;">{{ $cat->category_name }}</option>
            @foreach($subcat as $item)
                  <option value="{{ $item->id }}" @if($item->id == $data->subcategory_id) selected @endif  > ---- {{ $item->subcategory_name }}</option>
            @endforeach    
          @endforeach
          </select>
        </div>
        <input type="hidden" name="id" value="{{$data->id}}">
        <div class="form-group">
          <label for="category_name">Child Category Name</label>
          <input type="text" class="form-control"  name="childcategory_name" value="{{$data->childcategory_name}}" required="">
          <small id="emailHelp" class="form-text text-muted">This is your childcategory category</small>
        </div>   
    </div>
    <div class="modal-footer">
      <button type="Submit" class="btn btn-success">Update</button>
    </div>
    </form>