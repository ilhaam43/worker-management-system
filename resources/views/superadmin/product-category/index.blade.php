@extends('superadmin.layout.template')

@section('content')

        <!-- Begin Page Content -->
        <div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Product Category List</h1>
    
    <a href="#" class="btn btn-success btn-icon-split" data-toggle="modal" data-target="#addCategoryModal">
        <span class="text">Add product category</span>
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
        <h6 class="m-0 font-weight-bold text-primary">Product Category List</h6>
      </div>
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
            <thead>
              <tr>
                <th>No</th>
                <th>Name</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($productCategory as $categories)
              <tr>
                <td>{{ ++$i }}</td>
                <td>{{ $categories->category_name }}</td>
                <td>
                    <a class="btn btn-primary btn-sm" href="{{ route('superadmin.product-category.edit',$categories->id) }}">Edit</a>

                    <button class="btn btn-danger btn-sm remove-user" data-id="{{ $categories->id }}" data-action="{{ route('superadmin.product-category.destroy',$categories->id) }}" onclick="deleteConfirmation({{$categories->id}})"> Delete</button>
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
    <div class="modal fade" id="addCategoryModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Add Product Category</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">
        <form method="POST" action="{{url('superadmin/product-category')}}">
        {{ csrf_field() }}
        <div class="form-group">
          <label for="name"><b>Category Name :</label></b>
          <input type="text" name="category_name" class="form-control" id="category_name" required>
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
<script src="{{ asset('assets/superadmin/js/ajax/deleteProductCategory.js') }}"></script>
</html>
