@extends('admin.admin_master')

@section('admin')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <div class="container-full">
            <section class="content">

                <!-- Basic Forms -->
                <div class="box">
                    <div class="box-header with-border">
                        <h4 class="box-title">Add Designation</h4>
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

                                <form method="post" action="{{ route('employee.attendance.store') }}">
                                    @csrf

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <h5>Designation Name <span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <input type="date" name="name" class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-12">
                                            <table class="table table-bordered table-striped" style="width: 100%;">
                                                <thead>
                                                    <tr>
                                                        <th rowspan="2" class="text-center" style="vertical-align: middle;">#</th>
                                                        <th rowspan="2" class="text-center" style="vertical-align: middle;">Employee List</th>
                                                        <th colspan="3" class="text-center" style="vertical-align: middle; width: 30%;">Attendance Status</th>
                                                    </tr>
                                                    <tr>
                                                        <th class="text-center btn present_all" style="display: table-cell; background: #000000;">Present</th>
                                                        <th class="text-center btn leave_all" style="display: table-cell; background: #000000;">Leave</th>
                                                        <th class="text-center btn absent_all" style="display: table-cell; background: #000000;">Absent</th>
                                                    </tr>
                                                </thead>

                                                <tbody>
                                                    @foreach ($employees as $key => $employee)
                                                        <input type="hidden" name="employee_id[]" value="{{ $employee->id }}">
                                                        <tr id="div{{$employee->id}}" class="text-center">
                                                            <td>{{ $key+1 }}</td>
                                                            <td>{{ $employee->name }}</td>
                                                            <td colspan="3">
                                                                <div class="switch-toggle switch-3 switch-candy">
                                                                    <input name="attend_status{{$key}}" value="present" type="radio" id="present{{$key}}" checked="checked">
                                                                        <label for="present{{$key}}">Present</label>

                                                                    <input name="attend_status{{$key}}" value="leave" type="radio" id="leave{{$key}}">
                                                                        <label for="leave{{$key}}">Leave</label>

                                                                    <input name="attend_status{{$key}}" value="absent" type="radio" id="absent{{$key}}">
                                                                        <label for="absent{{$key}}">Absent</label>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>

                                    <div class="text-xs-right">
                                        <input type="submit" class="btn btn-rounded btn-primary" value="Add Attendance">
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
