@extends('admin.layout.template')

@section('content')

        <!-- Begin Page Content -->
        <div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Approved Work List</h1>
    
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

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
      <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Approved Work List</h6>
      </div>
      <div class="card-body">
      <a href="{{route('admin.work.export.excel.approved')}}" class="btn btn-success btn-sm" style="float: right; margin-right:10px;" id="export" class="main"><i class="fa fa-file-excel"></i> Export Excel</a>
      </br></br>
        <div class="table-responsive">
          <table class="table table-bordered display" id="dataTable" width="100%" cellspacing="0">
            <thead>
              <tr>
                    <th>#</th>
                    <th>No</th>
                    <th>Website</th>
                    <th>Email</th>
                    <th>Country</th>
                    <th>Remark</th>
                    <th>Worker</th>
                    <th>Screenshot</th>
                    <th>Action</th>
                </tr>
            </thead>
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

@include('admin.javascript.work.showApprovedWork')
</html>
