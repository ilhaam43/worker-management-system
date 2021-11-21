@extends('worker.layout.templates')

@section('content')
  <main id="main" data-aos="fade-up">

    <!-- ======= Breadcrumbs ======= -->
    <section class="breadcrumbs">
      <div class="container">
        <div class="d-flex justify-content-between align-items-center">
          <h3></h3>
          <ol>
            <li><a href="#">Worker</a></li>
            <li>Edit Work</li>
          </ol>
        </div>

      </div>
    </section><!-- End Breadcrumbs -->

    <div class="container h-page-80">

	
	<div class="form-group p-t-20 p-b-40">

        
    <div class="card mb-3">
    <div class="card-header bg-primary text-white"><i class="fa fa-edit"></i> Edit Work</div>
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

        <form method="POST" action="{{ route('worker.my-work.update',$listJobs->id) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="row">
        @if($listForm->website == 1)
        <div class="form-group col-md-6">
                <label>Company Website :</label>
                <input type="text" class="form-control" name="company_website" placeholder="Enter your name" value="{{$listJobs->company_website}}" required>
        </div>
        @endif
        @if($listForm->email == 1)
        <div class="form-group col-md-6">
                <label>Company Email :</label>
                <input type="text" class="form-control" name="company_email" value="{{$listJobs->company_email}}" required> 
            </div>
        @endif
        </div>
        <div class="row">
        @if($listForm->remark == 1)
        <div class="form-group col-md-6">
                <label>Remark :</label>
                <input type="text" class="form-control" name="remark" value="{{$listJobs->remark}}">
            </div>
        @endif
        @if($listForm->country == 1)
        <div class="form-group col-md-6">
        <label>Country :</label>
                    <select type="text" class="form-control" name="country_id">
                        @foreach($listCountries as $countries) 
                            <option value="{{$countries->id}}" {{ ( $countries->id == $listJobs->country->id) ? 'selected' : '' }}>{{$countries->country_name}}</option>
                        @endforeach
                    </select>
            </div>
        @endif
        </div>
        <div class="row">
        @if($listForm->name == 1)
        <div class="form-group col-md-6">
                <label>Name :</label>
                <input type="text" class="form-control" name="name" value="{{$listJobs->name}}">
            </div>
        @endif
        @if($listForm->number == 1)
        <div class="form-group col-md-6">
                <label>Number :</label>
                <input type="text" class="form-control" name="number" value="{{$listJobs->number}}">
            </div>
        @endif
        </div>
        <div class="row">
        @if($listForm->link == 1)
        <div class="form-group col-md-6">
                <label>Link :</label>
                <input type="text" class="form-control" name="link" value="{{$listJobs->link}}">
            </div>
        @endif
        @if($listForm->text == 1)
        <div class="form-group col-md-6">
                <label>Text :</label>
                <input type="text" class="form-control" name="number" value="{{$listJobs->text}}">
            </div>
        @endif
        </div>
        </br>
        <a href="{{url('worker/my-work')}}" class="btn btn-danger">Cancel</a>
        <button type="submit" class="btn btn-primary">Submit</button>
        </form>
            </div>

        </div>
    </div>
	</div>

</div>

  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  

  <div id="preloader"></div>
  <a href="#" class="back-to-top"><i class="icofont-simple-up"></i></a>
  @endsection

</body>

</html>