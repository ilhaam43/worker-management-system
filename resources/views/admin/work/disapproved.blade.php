@extends('admin.layout.template')

@section('content')

        <!-- Begin Page Content -->
        <div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Disapproved Work List</h1>
    
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
        <h6 class="m-0 font-weight-bold text-primary">Disapproved Work List</h6>
      </div>
      <div class="card-body">
      <button type="button" class="btn btn-primary btn-sm" id="selectAll" class="main"><i class="fa fa-check-circle"></i> Select All</button>
      <button type="button" class="btn btn-info btn-sm" id="openAll" class="main"><i class="fa fa-eye"></i> Open All</button>
      <button type="button" class="btn btn-danger btn-sm" style="float: right; margin-right:10px;" id="reject" class="main" onclick="rejectConfirmation()"><i class="fa fa-times"></i> Disapprove All</button>
      <button type="button" class="btn btn-success btn-sm" style="float: right; margin-right:10px;" id="approve" class="main" onclick="approveConfirmation()"><i class="fa fa-check"></i> Approve All</button>
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
                    <th>Name</th>
                    <th>Number</th>
                    <th>Link</th>
                    <th>Text</th>
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
@include('admin.javascript.work.openAllWork')
@include('admin.javascript.work.showDisapprovedWork')
</html>
