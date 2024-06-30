@extends('admin.admin_master')

@section('admin')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <div class="container-full">
            <section class="content">

                <!-- Basic Forms -->
                <div class="box">
                    <div class="box-header with-border">
                        <h4 class="box-title">Edit Employee: {{ $employee->name }}</h4>
                        <h6 class="box-subtitle">School Management Platform</h6>

                        @if ($errors->count())
                        <br>
                            @foreach ($errors->all() as $error)
                                <span class="btn btn-danger">{{ $error }}</span>
                            @endforeach
                        @endif

                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="row">
                            <div class="col">

                                <form method="post" action="{{ route('employee.registration.update', $employee->id) }}" enctype="multipart/form-data">
                                    @csrf

                                    <div class="row">

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <h5>Employee Name <span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <input type="text" name="name" value="{{ $employee->name }}" required class="form-control">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <h5>Employee Father`s Name <span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <input type="text" name="fname" value="{{ $employee->fname }}" required class="form-control">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <h5>Employee Mother`s Name <span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <input type="text" name="mname" value="{{ $employee->mname }}" required class="form-control">
                                                </div>
                                            </div>
                                        </div>

                                    </div>


                                    <div class="row">

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <h5>Employee Mobile<span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <input type="text" name="mobile" value="{{ $employee->mobile }}" required class="form-control">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <h5>Employee Address<span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <input type="text" name="address" value="{{ $employee->address }}" required class="form-control">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <h5>Employee Gender<span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <select name="gender" id="gender" class="form-control">
                                                        <option value="" selected disabled>Select Gender</option>
                                                        <option value="male" {{ $employee->gender == 'male' ? 'selected' : '' }}>Male</option>
                                                        <option value="female" {{ $employee->gender == 'female' ? 'selected' : '' }}>Female</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        
                                    </div>

                                    
                                    <div class="row">

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <h5>Employee Religion<span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <select name="religion" id="religion" class="form-control">
                                                        <option value="" selected disabled>Select Religion</option>
                                                        <option value="islam" {{ $employee->religion == 'islam' ? 'selected' : '' }}>Islam</option>
                                                        <option value="christian" {{ $employee->religion == 'christian' ? 'selected' : '' }}>Christian</option>
                                                        <option value="other" {{ $employee->religion == 'other' ? 'selected' : '' }}>Other</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <h5>Date of Birth<span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <input type="date" name="dob" value="{{ $employee->dob }}" required class="form-control">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <h5>Designation<span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <select name="designation_id" id="designation_id" class="form-control">
                                                        <option value="" selected disabled>Select Designation</option>

                                                        @foreach ($designations as $designation)
                                                            <option value="{{ $designation->id }}" {{ $employee->designation_id == $designation->id ? 'selected' : '' }}>
                                                                {{ $designation->name }}
                                                            </option>
                                                        @endforeach

                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        
                                    </div>

                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <h5>Employee Salary<span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <input type="text" name="salary" value="{{ $employee->salary }}" required class="form-control">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <h5>Joining Date<span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <input type="date" name="join_date" value="{{ $employee->join_date }}" required class="form-control">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <h5>Employee Email<span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <input type="email" name="email" value="{{ $employee->email }}" required class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <h5>Employee Image</h5>
                                                <div class="controls">
                                                    <input type="file" name="image" id="image" class="form-control">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <div class="controls">
                                                    <img style="width: 125px; height: 125px;" class="form-control"
                                                    id="showImage" src="{{ asset("storage/$employee->image") }}">
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="text-xs-right">
                                        <input type="submit" class="btn btn-rounded btn-primary" value="Update Employee">
                                    </div>
                                </form>

                            </div>
                            <!-- /.col -->
                        </div>
                        <!-- /.row -->
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->

            </section>
        </div>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#image').change(function(e) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#showImage').attr('src', e.target.result);
                }
                reader.readAsDataURL(e.target.files['0']);
            });
        });
    </script>

@endsection
