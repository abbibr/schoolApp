@extends('admin.admin_master')

@section('admin')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <div class="container-full">
            <!-- Main content -->
            <section class="content">
                <div class="row">

                    <div class="col-12">

                        <div class="box">
                            <div class="box-header with-border">

                                <h2 class="box-title">Employee Salary Details</h2>
                                <h5>Employee Name: {{ $employee_salaries[0]->user->name }}</h5>
                                <h5>Employee ID: {{ $employee_salaries[0]->user->id_no }}</h5>

                            </div>
                            <!-- /.box-header -->
                            <div class="box-body">
                                <div class="table-responsive">
                                    <table id="example1" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Previous Salary</th>
                                                <th>Increment Salary</th>
                                                <th>Present Salary</th>
                                                <th>Effected Date</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($employee_salaries as $id => $value)
                                                <tr>
                                                    <td width="5%">{{ $id + 1 }}</td>
                                                    <td>{{ $value->previous_salary }}</td>
                                                    <td>{{ $value->increment_salary }}</td>
                                                    <td>{{ $value->present_salary }}</td>
                                                    <td>{{ date('d/M/Y', strtotime($value->effected_salary)) }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <!-- /.box-body -->
                        </div>
                        <!-- /.box -->
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </section>
            <!-- /.content -->

        </div>
    </div>

@endsection
