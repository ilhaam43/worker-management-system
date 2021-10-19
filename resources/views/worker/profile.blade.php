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
            <li>Profile</li>
          </ol>
        </div>

      </div>
    </section><!-- End Breadcrumbs -->

    <div class="container h-page-80">

	
	<div class="form-group p-t-20 p-b-40">

        
    <div class="card mb-3">
    <div class="card-header bg-primary text-white"><i class="fa fa-users"></i> My Profile </div>
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

        <form method="POST" action="{{ route('worker.profile.update') }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="row">
        <div class="form-group col-md-4">
                <label>Name :</label>
                <input type="text" class="form-control" name="name" placeholder="Enter your name" value="{{$user->name}}">
            </div>
        <div class="form-group col-md-4">
                <label> Email :</label>
                <input type="text" class="form-control" name="email" value="{{$user->email}}" disabled> 
            </div>
            <div class="form-group col-md-4">
                <label>Country :</label>
                <select type="text" class="form-control" name="country_id">
                    @foreach($listCountries as $countries)
                    <option value="{{$countries->id}}" {{ ( $countries->id == $user->country_id) ? 'selected' : '' }}>{{$countries->country_name}}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="row">
        <div class="form-group col-md-6">
                <label>Password :</label>
                <input type="password" class="form-control" name="password" placeholder="Enter password you want to change">
            </div>
        <div class="form-group col-md-6">
                <label>Confirm Password :</label>
                <input type="password" class="form-control" name="confirm_password" placeholder="Enter your confirmation password">
            </div>
        </div>
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