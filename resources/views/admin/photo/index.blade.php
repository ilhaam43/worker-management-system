@extends('admin.layout.template')

@section('content')

        <!-- Begin Page Content -->
        <div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">List Photo</h1>
    
    <a href="#" class="btn btn-success btn-icon-split" data-toggle="modal" data-target="#addPhotoModal">
        <span class="text">Add Photo</span>
    </a>
    </br></br>
    @if (session('error'))
        <div class="alert alert-danger">
            <ul>
                <li>{{ session('error') }}</li>
            </ul>
        </div>
    @endif
    @if (session('success'))
        <div class="alert alert-success">
            <ul>
                <li>{{ session('success') }}</li>
            </ul>
        </div>
    @endif

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
      <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Photo List</h6>
      </div>
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
            <thead>
              <tr>
                <th>No</th>
                <th>Title</th>
                <th>Link</th>
                <th>Image</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($photo as $photos)
              <tr>
                <td>{{ ++$i }}</td>
                <td>{{ $photos->photo_name }}</td>
                <td>{{ url('/'.$photos->photo_url.'/')}}</td>
                <td><img src="{{asset($photos->photo_url)}}" width="120" height="120"></img></td>
                <td>
                <button class="btn btn-danger btn-sm remove-user" data-id="{{$photos->id}}" data-action="{{ route('admin.photos.destroy',$photos->id) }}" onclick="deleteConfirmation({{$photos->id}})"> Delete</button>
                  </form>
                </td>
              </tr>
            </tbody>
            @endforeach
          </table>
        </div>
      </div>
    </div>

    </div>
    <!-- /.container-fluid -->

    </div>

    <!-- Add Product Modal-->
    <div class="modal fade" id="addPhotoModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Add Photo</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">
        <form method="POST" action="{{route('admin.photos.store')}}" enctype="multipart/form-data">
        {{ csrf_field() }}
        <input type="hidden" name="product_category_id" value="{{Auth::user()->product_category_id}}">
        <div class="form-group">
          <label for="name"><b>Photo Name :</label></b>
          <input type="text" name="photo_name" class="form-control" id="photo_name" required>
          <label for="name"><b>Image :</label></b>
          <input type="file" name="photo_image" class="form-control" id="photo_image" required>
        </div>
        </div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
          <button type="submit" class="btn btn-primary">Submit</button>
          </form>
        </div>
      </div>
    </div>
  </div>

  
    <!-- End of Main Content -->
    
@endsection
</body>
<script src="{{ asset('assets/admin/js/ajax/deletePhoto.js') }}"></script>
</html>
