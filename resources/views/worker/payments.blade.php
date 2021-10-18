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
            <li>Payments</li>
          </ol>
        </div>

      </div>
    </section><!-- End Breadcrumbs -->

    <div class="container h-page-80">

	
	<div class="form-group p-t-20 p-b-40">

      
<div class="card mb-3">
  <div class="card-header backMainColor bg-primary text-white"><i class="fa fa-money-bill"></i> Payment and Quantity  </div>
  <div class="card-body shadow b-b-5">
  
      <div class="row">
          <div class="col-md-6 text-center ">
            <div class="form-group shadow m-b-30 b-1-ddd p-20 ">
            <h2 class="text-success"> <i class="fa fa-check-square fa-2x"></i></h2>
            <h2> Approved Quantity <br> <hr> {{$jobPaid ?? 0}}</h2></br>
          </div>
            </div>
          <div class="col-md-6 text-center">
            <div class="form-group shadow m-b-30 b-1-ddd p-20 ">
            <h2 class="text-success"><i class="fa fa-money-bill fa-2x"></i></h2>
            <h2> Paid Quantity <br><hr> {{$amountPaid ?? 0}}</h2></br>
          </div>
        </div>
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