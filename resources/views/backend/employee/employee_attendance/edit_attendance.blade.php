@extends('admin.admin_master')

@section('admin')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <div class="container-full">
            <section class="content">

                <!-- Basic Forms -->
                <div class="box">
                    <div class="box-header with-border">
                        <h4 class="box-title">Edit Employees` Attendance</h4>
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

                                <form method="post" action="{{ route('employee.attendance.update', $edit_employees[0]->date) }}">
                                    @csrf

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <h5>Attendance Date <span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <input type="date" name="date" value="{{ $edit_employees[0]->date }}" class="form-control">
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
                                                    @foreach ($edit_employees as $key => $employee)
                                                        <input type="hidden" name="employee_id[]" value="{{ $employee->id }}">
                                                        <tr id="div{{$employee->id}}" class="text-center">
                                                            <td>{{ $key+1 }}</td>
                                                            <td>{{ $employee->employee->name }}</td>
                                                            <td colspan="3">
                                                                <div class="switch-toggle switch-3 switch-candy">
                                                                    <input name="attend_status{{$key}}" type="radio" id="present{{$key}}" value="present" {{ $employee->attend_status == 'present' ? 'checked' : ''}}>
                                                                        <label for="present{{$key}}">Present</label>

                                                                    <input name="attend_status{{$key}}" type="radio" id="leave{{$key}}" value="leave" {{ $employee->attend_status == 'leave' ? 'checked' : ''}}>
                                                                        <label for="leave{{$key}}">Leave</label>

                                                                    <input name="attend_status{{$key}}" type="radio" id="absent{{$key}}" value="absent" {{ $employee->attend_status == 'absent' ? 'checked' : ''}}>
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
                                        <input type="submit" class="btn btn-rounded btn-primary" value="Update Attendance">
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
