@extends('admin.layout.template')

@section('content')

        <!-- Begin Page Content -->
        <div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Form Settings</h1>
    
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
        <h6 class="m-0 font-weight-bold text-primary">Form Settings</h6>
        </div>
        <div class="card-body">
        <form method="POST" action="{{ route('admin.form_settings.update') }}">
            @csrf
            <input type="hidden" name="product_category_id" value="{{Auth::user()->product_category_id}}">
            <div class="form-row">
                <div class="col-sm-4">
                    <label>Website :</label>
                    <select type="text" class="form-control" name="website">
                            <option value="1" {{ ( $formSetting->website == 1) ? 'selected' : '' }}>Yes</option>
                            <option value="0" {{ ( $formSetting->website == 0) ? 'selected' : '' }}>No</option>
                    </select>
                </div>
                <div class="col-sm-4">
                <label>Email :</label>
                    <select type="text" class="form-control" name="email">
                            <option value="1" {{ ( $formSetting->email == 1) ? 'selected' : '' }}>Yes</option>
                            <option value="0" {{ ( $formSetting->email == 0) ? 'selected' : '' }}>No</option>
                    </select>
                </div>
                <div class="col-sm-4">
                <label>Country :</label>
                    <select type="text" class="form-control" name="country">
                            <option value="1" {{ ( $formSetting->country == 1) ? 'selected' : '' }}>Yes</option>
                            <option value="0" {{ ( $formSetting->country == 0) ? 'selected' : '' }}>No</option>
                    </select>
                </div>
            </div>
            </br>
            <div class="form-row">
                <div class="col-sm-4">
                    <label>Screenshot :</label>
                        <select type="text" class="form-control" name="screenshot">
                                <option value="1" {{ ( $formSetting->screenshot == 1) ? 'selected' : '' }}>Yes</option>
                                <option value="0" {{ ( $formSetting->screenshot == 0) ? 'selected' : '' }}>No</option>
                        </select>
                </div>
                <div class="col-sm-4">
                    <label>Remark :</label>
                        <select type="text" class="form-control" name="remark">
                                <option value="1" {{ ( $formSetting->remark == 1) ? 'selected' : '' }}>Yes</option>
                                <option value="0" {{ ( $formSetting->remark == 0) ? 'selected' : '' }}>No</option>
                        </select>
                </div>
                <div class="col-sm-4">
                    <label>Name :</label>
                        <select type="text" class="form-control" name="name">
                                <option value="1" {{ ( $formSetting->name == 1) ? 'selected' : '' }}>Yes</option>
                                <option value="0" {{ ( $formSetting->name == 0) ? 'selected' : '' }}>No</option>
                        </select>
                </div>
            </div>
            </br>
            <div class="form-row">
                <div class="col-sm-4">
                    <label>Number :</label>
                        <select type="text" class="form-control" name="number">
                                <option value="1" {{ ( $formSetting->number == 1) ? 'selected' : '' }}>Yes</option>
                                <option value="0" {{ ( $formSetting->number == 0) ? 'selected' : '' }}>No</option>
                        </select>
                </div>
                <div class="col-sm-4">
                    <label>Link :</label>
                        <select type="text" class="form-control" name="link">
                                <option value="1" {{ ( $formSetting->link == 1) ? 'selected' : '' }}>Yes</option>
                                <option value="0" {{ ( $formSetting->link == 0) ? 'selected' : '' }}>No</option>
                        </select>
                </div>
                <div class="col-sm-4">
                    <label>Text :</label>
                        <select type="text" class="form-control" name="text">
                                <option value="1" {{ ( $formSetting->text == 1) ? 'selected' : '' }}>Yes</option>
                                <option value="0" {{ ( $formSetting->text == 0) ? 'selected' : '' }}>No</option>
                        </select>
                </div>
            </div>
        
            </br>
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
