<link rel="stylesheet" href="{{ asset('backend/plugins/summernote/summernote-bs4.css') }}">
<form action="{{route('setting.page.update')}}" method="Post">
    @csrf
    <div class="modal-body">
        <div class="form-group">
            <label for="page_position">Page Position</label>
            <select name="page_position" class="form-control">
                <option value="1" @if ($edit_page->page_position==1) selected @endif>Line One</option>
                <option value="2" @if ($edit_page->page_position==2) selected @endif>Line Two</option>
            </select>
        </div>
        <div class="form-group">
            <label for="page_name">Page Name</label>
            <input name="page_name" value="{{$edit_page->page_name}}" type="text" class="form-control" id="page_name" required="">
            <small id="emailHelp" class="form-text text-muted">This is your page name</small>
        </div>
        <input name="id" value="{{$edit_page->id}}" type="hidden">
        <div class="form-group">
            <label for="page_title">Page Title</label>
            <input name="page_title" value="{{$edit_page->page_title}}" type="text" class="form-control" id="page_title" required="">
            <small id="emailHelp" class="form-text text-muted">This is your page name</small>
        </div>
        <div class="form-group">
            <label for="page_description">Page Description</label>
            <textarea name="page_description" class="form-control textarea">{{$edit_page->page_description}}</textarea>
            <small id="emailHelp" class="form-text text-muted">This data will show on ypur website</small>
        </div>
    </div>
    <div class="modal-footer">
    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
    <button type="Submit" class="btn btn-success">Submit</button>
    </div>
</form>

<script src="{{ asset('backend/plugins/summernote/summernote-bs4.min.js') }}"></script>
<script>
    $(function () {
        // Summernote
        $('.textarea').summernote()
    })
</script>