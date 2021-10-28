@extends('admin.layout.template')

@section('content')

    <div class="container h-page-80">

	<div class="form-group p-t-20 p-b-40">

    <div class="card mb-3">
    <div class="card-header bg-primary text-white"><i class="fa fa-edit"></i> Edit Research Job</div>
    <div class="card-body shadow b-b-5">
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

        <form method="POST" action="{{ route('admin.work.update', $job->id) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="row">
                <div class="form-group col-md-6">
                    <label>Screenshot :</label>
                    </br>
                    <img src="{{asset($job->screenshot_url ? $job->screenshot_url : 'https://via.placeholder.com/450x400.png?text=No%20Image')}}" width="450" height="400"></img>
                </div>

            <div class="form-group col-md-6">
                <div class="row">
                    <div class="form-group col-md-6">
                        <label>Email :</label>
                        <input type="text" class="form-control" name="company_email" value="{{$job->company_email}}"> 
                    </div>
                    <div class="form-group col-md-6">
                        <label>Website :</label>
                        <input type="text" class="form-control" name="company_website" placeholder="Enter your name" value="{{$job->company_website}}">
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-md-12">
                        <label>Remark :</label>
                        <input type="text" class="form-control" name="remark" value="{{$job->remark}}"> 
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-md-6">
                        <label>Country :</label>
                        <select type="text" class="form-control" name="country_id">
                            @foreach($listCountries as $countries) 
                                <option value="{{$countries->id}}" {{ ( $countries->id == $job->country_id) ? 'selected' : '' }}>{{$countries->country_name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col-md-6">
                        <label>Status :</label>
                            <select type="text" class="form-control" name="job_status_id">
                                @foreach($jobsStatus as $jobsStatuses) 
                                    <option value="{{$jobsStatuses->id}}" {{ ( $jobsStatuses->id == $job->job_status_id) ? 'selected' : '' }}>{{$jobsStatuses->status}}</option>
                                @endforeach
                            </select>
                    </div>
                </div>
            </div>

        </div>

        <a href="{{url('admin/work/pending')}}" class="btn btn-danger">Cancel</a>
        <button type="submit" class="btn btn-primary">Submit</button>
        </form>
            </div>

        </div>
    </div>
	</div>

</div>

  <!-- ======= Footer ======= -->
  

  <div id="preloader"></div>
  <a href="#" class="back-to-top"><i class="icofont-simple-up"></i></a>
  @endsection

</body>

</html>