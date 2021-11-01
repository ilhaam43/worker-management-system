@extends('admin.layout.template')

@section('content')

        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">My Profile</h1>
            
          </div>
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

          <!-- Content Row -->
          <div class="row">
          <div class="form-group col-md-12">
            <form method="POST" action="{{ route('admin.profile.update') }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <input type="hidden" name="id" value="{{$user->id}}">
                <div class="row">
                    <div class="form-group col-md-6">
                        <label>Name :</label>
                        <input type="text" class="form-control" name="name" placeholder="Enter your name" value="{{$user->name}}"> 
                    </div>
                    <div class="form-group col-md-6">
                        <label>Email :</label>
                        <input type="text" class="form-control" name="email" placeholder="Enter your email" value="{{$user->email}}">
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-md-6">
                        <label>Password :</label>
                        <input type="password" class="form-control" name="password" placeholder="Enter your password"> 
                    </div>
                    <div class="form-group col-md-6">
                        <label>Confirm Password :</label>
                        <input type="password" class="form-control" name="confirm_password" placeholder="Enter your confirm password">
                    </div>
                </div>
                <a href="{{url('admin/')}}" class="btn btn-danger">Cancel</a>
                <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
            

          </div>

        <!-- Content Row -->

        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->
@endsection