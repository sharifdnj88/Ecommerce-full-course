<link rel="stylesheet" type="text/css" href="https://jeremyfagis.github.io/dropify/dist/css/dropify.min.css">
<form action="{{ route('brand.update') }}" method="Post" enctype="multipart/form-data">
    @csrf
    <div class="modal-body">
        <div class="form-group">
          <label for="brand-name">Brand Name</label>
          <input type="text" class="form-control"  name="brand_name" value="{{ $data->brand_name }}" required="">
          <small id="emailHelp" class="form-text text-muted">This is your Brand </small>
        </div>
        <input type="hidden" name="id" value="{{ $data->id }}">
         <div class="form-group">
          <label for="brand-name">Old Brand Logo</label>
          <img class="img-thumbnail" src="{{url('storage/brands/' .$data -> brand_logo)}}" alt="" width="120" height="120">
        </div> 
         <div class="form-group">
          <label for="brand-name">Brand Logo</label>
          <input type="file"  class="dropify" data-height="140"  name="brand_logo" >
          <input type="hidden" name="old_logo" value="{{ $data->brand_logo }}">
        </div> 
    </div>
    <div class="modal-footer">
      <button type="Submit" class="btn btn-primary"> <span class="d-none"> loading..... </span>  Update</button>
    </div>
</form>

<script type="text/javascript" src="https://jeremyfagis.github.io/dropify/dist/js/dropify.min.js"></script>
<script>
    $('.dropify').dropify();
</script>