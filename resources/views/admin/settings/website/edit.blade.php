<link rel="stylesheet" type="text/css" href="https://jeremyfagis.github.io/dropify/dist/css/dropify.min.css">
<form action="{{route('setting.website.update')}}" method="Post" enctype="multipart/form-data">
    @csrf
    <div class="card-body">
      <div class="form-group">
        <label for="exampleInputEmail1">Currency</label>
         <select class="form-control" name="currency">
              <option value="৳" @if($edit->currency=="৳") selected @endif>Taka (৳)</option>
              <option value="$" @if($edit->currency=="$") selected @endif>USD ($)</option>                        
         </select>
      </div>
      <input name="id" value="{{$edit->id}}" type="hidden">
      <div class="form-group">
        <label for="exampleInputEmail1">Phone One</label>
        <input name="phone_one" type="text" class="form-control" value="{{$edit->phone_one}}" required="">
      </div>
       <div class="form-group">
        <label for="exampleInputEmail1">Phone Two</label>
        <input type="text" class="form-control" name="phone_two" value="{{$edit->phone_two}}" required="">
      </div>
      <div class="form-group">
        <label for="exampleInputEmail1">Main Email</label>
        <input type="email" class="form-control" name="main_email" value="{{$edit->main_email}}" >
      </div>
       <div class="form-group">
        <label for="exampleInputEmail1">Support Email</label>
        <input type="email" class="form-control" name="support_email" value="{{$edit->support_email}}" >
      </div>
      <div class="form-group">
        <label for="exampleInputEmail1">Address</label>
        <input type="text" class="form-control" name="address" value="{{$edit->address}}" >
      </div>
     
      <div class="form-group text-center">
        <strong class="text-primary"><i class="fa fa-share-alt-square"></i> Social Link</strong>
      </div>              
      
      <div class="form-group">
        <label for="exampleInputEmail1">Facebook</label>
        <input type="text" class="form-control" name="facebook" value="{{$edit->facebook}}" >
      </div>
      <div class="form-group">
        <label for="exampleInputEmail1">Twitter</label>
        <input type="text" class="form-control" name="twitter" value="{{$edit->twitter}}" >
      </div>
      <div class="form-group">
        <label for="exampleInputEmail1">Instagram</label>
        <input type="text" class="form-control" name="instagram" value="{{$edit->instagram}}" >
      </div>
      <div class="form-group">
        <label for="exampleInputEmail1">Linkedin</label>
        <input type="text" class="form-control" name="linkedin" value="{{$edit->linkedin}}" >
      </div>
      <div class="form-group">
        <label for="exampleInputEmail1">Youtube</label>
        <input type="text" class="form-control" name="youtube" value="{{$edit->youtube}}" >
      </div>

      <div class="form-group text-center">
        <strong class="text-primary"><i class="fa fa-file-image-o"></i> Logo & Favicon</strong>
      </div>  

      <div class="form-group">
        <label for="exampleInputEmail1">Main Logo</label>
        <input type="file" class="form-control dropify" name="logo" >
        <input name="old_logo" value="{{$edit->logo}}" type="hidden" class="form-control">
      </div>
      <div class="form-group">
        <label for="exampleInputEmail1">Favicon</label>
        <input type="file" class="form-control dropify" name="favicon">
        <input name="old_favicon" value="{{$edit->favicon}}" type="hidden" class="form-control">
      </div>
    </div>
    <div class="card-footer text-right">
      <button type="submit" class="btn btn-success">Submit</button>
    </div>
  </form>

  
<script type="text/javascript" src="https://jeremyfagis.github.io/dropify/dist/js/dropify.min.js"></script>
<script>
    $('.dropify').dropify();
</script>