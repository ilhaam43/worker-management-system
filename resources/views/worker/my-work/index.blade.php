@extends('worker.layout.templates')

@section('content')
  <main id="main" data-aos="fade-up">

    <!-- ======= Breadcrumbs ======= -->
    <section class="breadcrumbs">
        <div class="d-flex justify-content-between align-items-center">
          <h3></h3>
          <ol>
            <li style="margin-left:20px;"><a href="#">Worker</a></li>
            <li style="margin-right:20px;">My Work</li>
          </ol>
        </div>
    </section><!-- End Breadcrumbs -->

    <div class="card shadow mb-4">
      <div class="card-body">
      <h4 style="margin-left:10px;">My Work List</h4>

      <a href="#" class="btn btn-outline-primary btn-icon-split" data-toggle="modal" data-target="#addCompanyModal" style="margin-left:10px;"><i class="fa fa-building p-r-5"></i>
        <span class="text">Add New Work</span>
      </a>
        
      
    
      </br>
      </br>

      @if (session('error'))
      </br>
        <div class="alert alert-danger">
            <ul>
                <li>{{ session('error') }}</li>
            </ul>
        </div>
    @endif
    @if (session('success'))
      </br>
        <div class="alert alert-success">
            <ul>
                <li>{{ session('success') }}</li>
            </ul>
        </div>
    @endif
    <div class="table-responsive">
              <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  </br>
                  <thead>
                    <tr>
                      <th width="5%">No</th>
                      <th>Website</th>
                      <th>Email</th>
                      <th>Country</th>
                      <th>Screenshot</th>
                      <th>Remark</th>
                      <th>Status</th>
                      <th>Edit</th>
                    </tr>
                  </thead>
                </table>
              </div>
            </div>
        </div>
    </div>  
</div>
  
  </main><!-- End #main -->

  <!-- Add Company Modal-->
  <div class="modal fade" id="addCompanyModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Add New Work</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">
        <form method="POST" action="{{route('worker.my-work.store')}}" enctype="multipart/form-data">
        {{ csrf_field() }}
        <input type="hidden" name="user_id" value="{{$user->id}}">
        <input type="hidden" name="job_status_id" value="3">
        <input type="hidden" name="product_category_id" value="{{$user->product_category_id}}">
        <div class="form-group">
          <label for="name">Website :</label>
          <input type="text" name="company_website" class="form-control" id="company_website" required onblur="checkWebsite()">
        </div>
        <div class="form-group">
          <label for="name">Email :</label>
          <input type="text" name="company_email" class="form-control" id="company_email" required onblur="checkEmail()">
        </div>
        <div class="form-group">
          <label for="name">Screenshot :</label>
          <input type="file" name="screenshot" class="form-control" id="screenshot" required>
        </div>
        <div class="form-group">
        <label>Country :</label>
                <select type="text" class="form-control" name="country_id">
                @foreach($listCountries as $countries)
                    <option value="{{$countries->id}}">{{$countries->country_name}}</option>
                @endforeach
        </select>
        </div>
        <div class="form-group">
          <label for="name">Remark :</label>
          <input type="text" name="remark" class="form-control" id="remark">
          <small id="remark-notes" class="form-text text-muted"> Notes : if remark not available just leave empty in remark form.</small>
        </div>

        </div>
        <div class="modal-footer">
          <button class="btn btn-danger" type="button" data-dismiss="modal">Cancel</button>
          <button type="submit" class="btn btn-primary">Submit</button>
          </form>
        </div>
      </div>
    </div>
  </div>

  

  <!-- ======= Footer ======= -->
  

  <div id="preloader"></div>
  <a href="#" class="back-to-top"><i class="icofont-simple-up"></i></a>
  @endsection

  
</body>
@include('worker.javascript.showMyWorkData')
<script>
function checkWebsite(){
    let companyWebsite = document.getElementById("company_website");
    let CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
    companyWebsite = companyWebsite.value;
    
    $.ajax({
                type: 'POST',
                url: "/data/validation/website",
                cache: false,
                data: {_token: CSRF_TOKEN, company_website:companyWebsite},
                dataType: 'JSON',
                success: function (results) {
                  console.log(results.success);
                    if (results.success == true && results.empty == false) {
                        $('#company_website').css('border', '3px solid #16e445');
                        $('#company_website').nextAll().remove();
                    } else if(results.success == false && results.empty == false) {
                      console.log('error');
                        $('#company_website').css({"border":"3px solid red"});
                        $('#company_website').nextAll().remove();
                        $('#company_website').after("<p style=color:red;>This website already exists, please re-enter another website</p>");
                    } else if(results.success == false && results.empty == true){
                        $('#company_website').css({"border":""});
                        $('#company_website').nextAll().remove();
                    }
                }
      });
}

function checkEmail(){
    let companyEmail = document.getElementById("company_email");
    let CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
    companyEmail = companyEmail.value;
    
    $.ajax({
                type: 'POST',
                url: "/data/validation/email",
                cache: false,
                data: {_token: CSRF_TOKEN, company_email:companyEmail},
                dataType: 'JSON',
                success: function (results) {
                  console.log(results.success);
                    if (results.success == true && results.empty == false) {
                        $('#company_email').css('border', '3px solid #16e445');
                        $('#company_email').nextAll().remove();
                    } else if(results.success == false && results.empty == false) {
                      console.log('error');
                        $('#company_email').css({"border":"3px solid red"});
                        $('#company_email').nextAll().remove();
                        $('#company_email').after("<p style=color:red;>This email already exists, please re-enter another email</p>");
                    } else if(results.success == false && results.empty == true){
                        $('#company_email').css({"border":""});
                        $('#company_email').nextAll().remove();
                    }
                }
      });
}
</script>
</html>