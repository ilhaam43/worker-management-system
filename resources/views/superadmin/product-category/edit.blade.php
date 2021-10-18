@extends('superadmin.layout.template')

@section('content')

        <!-- Begin Page Content -->
        <div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Edit Product Category</h1>
    
    </br>
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

    <div class="card shadow mb-4">
      <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Edit Product Category</h6>
      </div>
      <div class="card-body">
      <form method="POST" action="{{ route('superadmin.product-categories.update',$productCategory->id) }}">
          @csrf
          @method('PUT')
          <div class="form-row">
            <div class="col-sm-6">
              <label for="name"><b>Category Name :</label></b>
              <input type="text" class="form-control" placeholder="Category Name" name="category_name" value="{{$productCategory->category_name}}" required>
            </div>
          </div>
          </br>
          <a href="{{url('superadmin/product-categories')}}" class="btn btn-danger">Cancel</a>
          <button type="submit" class="btn btn-primary">Submit</button>
        </form>
      </div>
    </div>

    </div>
    <!-- /.container-fluid -->

    </div>

  
    <!-- End of Main Content -->
    
@endsection
</body>

</html>
