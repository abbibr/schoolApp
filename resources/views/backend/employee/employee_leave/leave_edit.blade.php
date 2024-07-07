@extends('admin.admin_master')

@section('admin')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <div class="container-full">
            <section class="content">

                <!-- Basic Forms -->
                <div class="box">
                    <div class="box-header with-border">
                        <h4 class="box-title">Edit: Employee Leave</h4>
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

                                <form method="post" action="{{ route('employee.leave.update', $employee_leave->id) }}">
                                    @csrf

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <h5>Employee Name <span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <select name="employee_id" id="employee_id" class="form-control">
                                                        <option value="" selected disabled>Select Employee</option>
                                                        
                                                        @foreach ($employees as $key => $value)

                                                            <option value="{{ $value->id }}" {{ $employee_leave->employee_id == $value->id ? 'selected' : '' }}>
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
                                                    <input type="date" name="start_date" value="{{ $employee_leave->start_date }}" class="form-control">
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
                                                            <option value="{{ $value->id }}" {{ $employee_leave->purpose_id == $value->id ? 'selected' : '' }}>
                                                                {{ $value->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>

                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <h5>End Date <span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <input type="date" value="{{ $employee_leave->end_date }}" name="end_date" class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="text-xs-right">
                                        <input type="submit" class="btn btn-rounded btn-primary" value="Update">
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
@endsection
