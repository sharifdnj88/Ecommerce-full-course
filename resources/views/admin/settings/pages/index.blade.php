@extends('layouts.admin')

@section('admin_content')
<div class="page-wrapper">			
    <div class="content container-fluid">        
        @include('layouts.admin_partial.page_header')

        <div class="row">
            <div class="col-sm-12">
                <div class="card shadow">
                    <div class="card-header text-center">
                        <h3 class="card-title btn btn-secondary btn-lg">All Pages list here</h3>
                        <button class="btn btn-danger btn-lg" data-toggle="modal" data-target="#pageModal"> <i class="fa fa-plus"></i> Add New Page</button>
                    </div>
                    <div class="card-body">
                        <span style="text-align:center">@include('validate')</span>
                        <div class="table-responsive">
                            <table class="table mb-0 data-table-said table-bordered table-primary table-sm">
                                <thead>
                                    <tr>
                                        <th>SL</th>
                                        <th>Page Name</th>
                                        <th>Page Title</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($page as $item)
                                        <tr>
                                            <td>{{$loop-> index  + 1}}</td>
                                            <td>{{ $item -> page_name }}</td>
                                            <td>{{ $item -> page_title }}</td>                                            
                                            <td>
                                                <a href="#" class="btn btn-sm btn-warning edit" data-id="{{ $item->id }}" data-toggle="modal" data-target="#editModal" ><i class="fa fa-edit" ></i></a>                                                
                                                <a href="{{route('setting.page.delete', $item->id)}}" class="btn btn-sm btn-danger" id="delete" ><i class="fa fa-trash" ></i></a>
                                        </td>
                                        </tr>    
                                    @empty
                                        <tr>
                                            <td class="text-danger text-center font-weight-bold" colspan="5">No records found</td>
                                        </tr>
                                    @endforelse
                                    
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>     

    </div>			
</div>

{{-- brand insert modal --}}
<div class="modal fade" id="pageModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Add New Page</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="{{route('setting.page.store')}}" method="Post">
            @csrf
            <div class="modal-body">
                <div class="form-group">
                    <label for="page_position">Page Position</label>
                    <select name="page_position" class="form-control">
                        <option value="1">Line One</option>
                        <option value="2">Line Two</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="page_name">Page Name</label>
                    <input name="page_name" type="text" class="form-control" id="page_name" required="">
                    <small id="emailHelp" class="form-text text-muted">This is your page name</small>
                </div>
                <div class="form-group">
                    <label for="page_title">Page Title</label>
                    <input name="page_title" type="text" class="form-control" id="page_title" required="">
                    <small id="emailHelp" class="form-text text-muted">This is your page name</small>
                </div>
                <div class="form-group">
                    <label for="page_description">Page Description</label>
                    <textarea name="page_description" class="form-control textarea"></textarea>
                    <small id="emailHelp" class="form-text text-muted">This data will show on ypur website</small>
                </div>
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            <button type="Submit" class="btn btn-success">Submit</button>
            </div>
        </form>
      </div>
    </div>
</div>

{{-- Edit brand modal --}}
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Edit Page</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div id="modal_body">
            {{-- Data came from edit.blade.php --}}
        </div>
      </div>
    </div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<script type="text/javascript">
	$('body').on('click', '.edit', function(){
        let page_id =$(this).data('id');
        $.get('page/edit/'+page_id, function(data){
            $('#modal_body').html(data);
            
        });
    });

</script>


@endsection
