@extends('admin.layout.template')

@section('content')

        <!-- Begin Page Content -->
        <div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Edit Worker User</h1>
    
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
        <h6 class="m-0 font-weight-bold text-primary">Edit Worker User</h6>
        </div>
        <div class="card-body">
        <form method="POST" action="{{ route('admin.workers.update', $worker['id']) }}">
            @csrf
            @method('PUT')
            <h5 class="m-0 font-weight-bold text-primary">Payment & Quantity :</h5>
            <hr>
            <div class="form-row">
                <div class="col-sm-6" style="margin: 0 auto;">
                <center><h5 class="m-0 font-weight-bold">Job Quantity</h5></center>
                </br>
                <center><h5 class="m-0 font-weight-bold">Total : {{$countJobs ?? 0}}</h5></center>
                </br>
                <center><h6 class="m-0 font-weight-bold">Enter Paid Job :</h6></center>
                <input type="text" class="form-control" name="quantity_jobs_paid" value="{{$workerDetails->quantity_jobs_paid ?? 0}}" required>
                </div>
            </div>
            </br>
            <h5 class="m-0 font-weight-bold text-primary">Profile Data :</h5>
            <hr>
            <div class="form-row">
                <div class="col-sm-4">
                <label for="name"><b>Name :</label></b>
                <input type="text" class="form-control" placeholder="Name" name="name" value="{{$worker->name}}" required>
                </div>
                <div class="col-sm-4">
                <label for="name"><b>Email :</label></b>
                <input type="text" class="form-control" placeholder="Email" name="email" value="{{$worker->email}}" required>
                </div>
                <div class="col-sm-4">
                <label for="name"><b>Enter Amount Paid :</label></b>
                <input type="text" class="form-control" name="amount_paid" value="{{$workerDetails->amount_paid ?? 0}}" required>
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
                        <option value="{{$countries->id}}" {{ ( $countries->id == $worker->country_id) ? 'selected' : '' }}>{{$countries->country_name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-sm-4">
                    <label for="name"><b>Product Category :</label></b>
                    <select class="form-control" name="product_category_id">
                        @foreach($productCategory as $categories)
                        <option value="{{$categories->id}}" {{ ( $categories->id == $worker->product_category_id) ? 'selected' : '' }}>{{$categories->category_name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-sm-4">
                    <label for="name"><b>Status :</label></b>
                    <select class="form-control" name="status_id">
                        @foreach($usersStatus as $status)
                        <option value="{{$status->id}}" {{ ( $status->id == $worker->status_id) ? 'selected' : '' }}> {{$status->status}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </br>
            <a href="{{route('admin.workers.index')}}" class="btn btn-danger">Cancel</a>
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
