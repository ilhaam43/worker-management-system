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
                <div class="form-group col-md-7">
                    <label>Screenshot :</label>
                    </br>
                    <img src="{{asset($job->screenshot_url ? $job->screenshot_url : 'https://via.placeholder.com/450x400.png?text=No%20Image')}}" width="550" height="450"></img>
                </div>

            <div class="form-group col-md-5">
                <div class="row">
                    @if($listForm->email == 1)
                    <div class="form-group col-md-12">
                        <label>Email :</label>
                        <input type="text" class="form-control" name="company_email" value="{{$job->company_email}}"> 
                    </div>
                    @endif
                    @if($listForm->website == 1)
                    <div class="form-group col-md-12">
                        <label>Website :</label>
                        <input type="text" class="form-control" name="company_website" placeholder="Enter your name" value="{{$job->company_website}}">
                    </div>
                    @endif
                </div>
                <div class="row">
                    @if($listForm->remark == 1)
                    <div class="form-group col-md-6">
                        <label>Remark :</label>
                        <input type="text" class="form-control" name="remark" value="{{$job->remark}}"> 
                    </div>
                    @endif
                    @if($listForm->text == 1)
                    <div class="form-group col-md-6">
                        <label>Text :</label>
                        <input type="text" class="form-control" name="text" value="{{$job->text}}"> 
                    </div>
                    @endif
                </div>
                <div class="row">
                    @if($listForm->country == 1)
                    <div class="form-group col-md-6">
                        <label>Country :</label>
                        <select type="text" class="form-control" name="country_id">
                            @foreach($listCountries as $countries) 
                                <option value="{{$countries->id}}" {{ ( $countries->id == $job->country_id) ? 'selected' : '' }}>{{$countries->country_name}}</option>
                            @endforeach
                        </select>
                    </div>
                    @endif
                    @if($listForm->name == 1)
                    <div class="form-group col-md-6">
                        <label>Name :</label>
                        <input type="text" class="form-control" name="name" value="{{$job->name}}"> 
                    </div>
                    @endif
                </div>
                <div class="row">
                    @if($listForm->number == 1)
                    <div class="form-group col-md-6">
                        <label>Number :</label>
                        <input type="text" class="form-control" name="number" value="{{$job->number}}"> 
                    </div>
                    @endif
                    @if($listForm->link == 1)
                    <div class="form-group col-md-6">
                        <label>Link :</label>
                        <input type="text" class="form-control" name="link" value="{{$job->link}}"> 
                    </div>
                    @endif
                </div>
                <div class="row">
                    <div class="form-group col-md-12">
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