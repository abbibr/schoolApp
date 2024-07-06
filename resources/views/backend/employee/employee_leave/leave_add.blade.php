@extends('admin.admin_master')

@section('admin')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <div class="container-full">
            <section class="content">

                <!-- Basic Forms -->
                <div class="box">
                    <div class="box-header with-border">
                        <h4 class="box-title">Employee Leave</h4>
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

                                <form method="post" action="{{ route('employee.leave.store') }}">
                                    @csrf

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <h5>Employee Name <span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <select name="employee_id" id="employee_id" class="form-control">
                                                        <option value="" selected disabled>Select Employee</option>
                                                        
                                                        @foreach ($employees as $value)
                                                            <option value="{{ $value->id }}">
                                                                {{ $value->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <h5>Start Date <span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <input type="date" name="start_date" class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <h5>Leave Purpose <span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <select name="purpose_id" id="purpose_id" class="form-control">
                                                        <option value="" selected disabled>Select Employee</option>
                                                        
                                                        @foreach ($purposes as $value)
                                                            <option value="{{ $value->id }}">
                                                                {{ $value->name }}
                                                            </option>
                                                        @endforeach

                                                        <option value="0">New Purpose</option>
                                                    </select>

                                                    <input type="text" name="name" id="add_another" class="form-control" style="display: none;" placeholder="Write Purpose">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <h5>End Date <span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <input type="date" name="end_date" class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="text-xs-right">
                                        <input type="submit" class="btn btn-rounded btn-primary" value="Submit">
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
            $(document).on('change', '#purpose_id', function() {
                var leave_purpose_id = $(this).val();

                if(leave_purpose_id == 0) {
                    $('#add_another').show();
                }
                else {
                    $('#add_another').hide();
                }
            });
        });
    </script>
@endsection
