@extends('superadmin.layout.template')

@section('content')

        <!-- Begin Page Content -->
        <div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Edit Admin User</h1>
    
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
        <h6 class="m-0 font-weight-bold text-primary">Edit Admin User</h6>
        </div>
        <div class="card-body">
        <form method="POST" action="{{ route('superadmin.admins.update',$admin->id) }}">
            @csrf
            @method('PUT')
            <div class="form-row">
                <div class="col-sm-6">
                <label for="name"><b>Name :</label></b>
                <input type="text" class="form-control" placeholder="Name" name="name" value="{{$admin->name}}" required>
                </div>
                <div class="col-sm-6">
                <label for="name"><b>Email :</label></b>
                <input type="text" class="form-control" placeholder="Email" name="email" value="{{$admin->email}}" required>
                </div>
            </div>
            </br>
            <div class="form-row">
                <div class="col-sm-6">
                <label for="name"><b>Pasword :</label></b>
                <input type="password" class="form-control" placeholder="Password" name="password">
                </div>
                <div class="col-sm-6">
                <label for="name"><b>Confirm Password :</label></b>
                <input type="password" class="form-control" placeholder="Confirm Password" name="confirm_password">
                </div>
            </div>
            </br>
            <div class="form-row">
            <div class="col-sm-4">
                <label for="name"><b>Country :</label></b>
                <select class="form-control" name="country_id">
                    @foreach($listCountries as $countries)
                    <option value="{{$countries->id}}" {{ ( $countries->id == $admin->country_id) ? 'selected' : '' }}>{{$countries->country_name}}</option>
                    @endforeach
                </select>
                </div>
            <div class="col-sm-4">
                <label for="name"><b>Product Category :</label></b>
                <select class="form-control" name="product_category_id">
                    @foreach($productCategory as $categories)
                    <option value="{{$categories->id}}" {{ ( $categories->id == $admin->product_category_id) ? 'selected' : '' }}>{{$categories->category_name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-sm-4">
                <label for="name"><b>Status :</label></b>
                <select class="form-control" name="status_id">
                    @foreach($usersStatus as $status)
                    <option value="{{$status->id}}" {{ ( $status->id == $admin->status_id) ? 'selected' : '' }}> {{$status->status}}</option>
                    @endforeach
                </select>
            </div>
            </div>
            </br>
            <a href="{{url('superadmin/admin')}}" class="btn btn-danger">Cancel</a>
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
