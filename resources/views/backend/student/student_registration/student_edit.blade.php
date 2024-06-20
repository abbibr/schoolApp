@extends('admin.admin_master')

@section('admin')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <div class="container-full">
            <section class="content">

                <!-- Basic Forms -->
                <div class="box">
                    <div class="box-header with-border">
                        <h4 class="box-title">Edit Student</h4>
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

                                <form method="post" action="{{ route('student.registration.update', $edit_student->id) }}" enctype="multipart/form-data">
                                    @csrf

                                    <div class="row">

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <h5>Student Name <span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <input type="text" value="{{ $edit_student->student->name }}" name="name" required class="form-control">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <h5>Student Father`s Name <span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <input type="text" value="{{ $edit_student->student->fname }}" name="fname" required class="form-control">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <h5>Student Mother`s Name <span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <input type="text" value="{{ $edit_student->student->mname }}" name="mname" required class="form-control">
                                                </div>
                                            </div>
                                        </div>

                                    </div>


                                    <div class="row">

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <h5>Student Mobile<span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <input type="text" value="{{ $edit_student->student->mobile }}" name="mobile" required class="form-control">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <h5>Student Address<span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <input type="text" value="{{ $edit_student->student->address }}" name="address" required class="form-control">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <h5>Student Gender<span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <select name="gender" id="gender" class="form-control">
                                                        <option value="" selected disabled>Select Gender</option>
                                                        <option value="male" {{ $edit_student->student->gender == 'male' ? 'selected' : '' }}>Male</option>
                                                        <option value="female" {{ $edit_student->student->gender == 'female' ? 'selected' : '' }}>Female</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        
                                    </div>

                                    
                                    <div class="row">

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <h5>Student Religion<span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <select name="religion" id="religion" class="form-control">
                                                        <option value="" selected disabled>Select Religion</option>
                                                        <option value="islam" {{ $edit_student->student->religion == 'islam' ? 'selected' : '' }}>Islam</option>
                                                        <option value="christian" {{ $edit_student->student->religion == 'christian' ? 'selected' : '' }}>Christian</option>
                                                        <option value="other" {{ $edit_student->student->religion == 'other' ? 'selected' : '' }}>Other</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <h5>Date of Birth<span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <input type="date" value="{{ $edit_student->student->dob}}" name="dob" required class="form-control">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <h5>Discount (%)<span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <input type="text" value="{{ $edit_student->discount[0]->discount }}" name="discount" required class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                        
                                    </div>


                                    <div class="row">

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <h5>Year<span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <select name="year_id" id="year_id" class="form-control">
                                                        <option value="" selected disabled>Select Year</option>

                                                        @foreach ($years as $year)
                                                            <option value="{{ $year->id }}" {{ $edit_student->year_id == $year->id ? 'selected' : '' }}>
                                                                {{ $year->name }}
                                                            </option>
                                                        @endforeach

                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <h5>Class<span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <select name="class_id" id="class_id" class="form-control">
                                                        <option value="" selected disabled>Select Class</option>
                                                       
                                                        @foreach ($classes as $class)
                                                            <option value="{{ $class->id }}" {{ $edit_student->class_id == $class->id ? 'selected' : '' }}>
                                                                {{ $class->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <h5>Group<span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <select name="group_id" id="group_id" class="form-control">
                                                        <option value="" selected disabled>Select Group</option>
                                                        
                                                        @foreach ($groups as $group)
                                                            <option value="{{ $group->id }}" {{ $edit_student->group_id == $group->id ? 'selected' : '' }}>
                                                                {{ $group->name }}
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
                                                <h5>Shift<span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <select name="shift_id" id="shift_id" class="form-control">
                                                        <option value="" selected disabled>Select Shift</option>

                                                        @foreach ($shifts as $shift)
                                                            <option value="{{ $shift->id }}" {{ $edit_student->shift_id == $shift->id ? 'selected' : '' }}>
                                                                {{ $shift->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <h5>Student Image</h5>
                                                <div class="controls">
                                                    <input type="file" name="image" id="image" class="form-control">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <div class="controls">
                                                    <img style="width: 125px; height: 125px;" class="form-control"
                                                    id="showImage" src="{{ asset("storage/".$edit_student->student->image) }}">
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="text-xs-right">
                                        <input type="submit" class="btn btn-rounded btn-primary" value="Update Student">
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
