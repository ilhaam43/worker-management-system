@extends('admin.layout.template')

@section('content')

    <!-- Begin Page Content -->
    <div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">List Settings</h1>
    
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
        <h6 class="m-0 font-weight-bold text-primary">Settings List</h6>
      </div>
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-bordered" width="100%" cellspacing="0">
            <thead>
              <tr>
                <th>No</th>
                <th>Title</th>
                <th>Description</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($setting as $settings)
              <tr>
                <td>{{ ++$i }}</td>
                <td>{{ $settings->setting_name }}</td>
                <td>{!! $settings->setting_description !!}</td>
                <td>
                    <a class="btn btn-primary btn-sm" href="{{ route('admin.settings.edit',$settings->id) }}">Edit</a></br></br>
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
    <!-- End of Main Content -->
    
@endsection
</body>
<script src="{{ asset('assets/admin/js/ajax/deleteGeneralSetting.js') }}"></script>
</html>
