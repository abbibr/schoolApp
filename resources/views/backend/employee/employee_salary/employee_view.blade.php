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

                                <h3 class="box-title">Employee Salary List</h3>
                                <a href="{{ route('employee.registration.add') }}" style="float: right;"
                                    class="btn btn-rounded btn-info mb-5">Add Employee Salary</a>

                            </div>
                            <!-- /.box-header -->
                            <div class="box-body">
                                <div class="table-responsive">
                                    <table id="example1" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Name</th>
                                                <th>ID No</th>
                                                <th>Mobile</th>
                                                <th>Gender</th>
                                                <th>Join Date</th>
                                                <th>Salary</th>
                                                <th>Designation</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                            @if ($datas->count())
                                                @foreach ($datas as $id => $data)
                                                    <tr>
                                                        <td width="5%">{{ $id + 1 }}</td>
                                                        <td>{{ $data->name }}</td>
                                                        <td>{{ $data->id_no }}</td>
                                                        <td>{{ $data->mobile }}</td>
                                                        <td>{{ $data->gender }}</td>
                                                        <td>{{ date('d/M/Y', strtotime($data->join_date)) }}</td>
                                                        <td>{{ $data->employee_salary->last()->present_salary }}</td>
                                                        <td>{{ $data->designation->name }}</td>
                                                        <td width="25%">
                                                            <a title="Increment" href="{{ route('employee.salary.increment', $data->id) }}"
                                                                class="btn btn-info"><i class="fa fa-plus-circle"></i></a> &nbsp;
                                                            <a title="Details" href="{{ route('employee.registration.details', $data->id) }}"
                                                                class="btn btn-primary"><i class="fa fa-eye"></i></a>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            @else
                                                <h3 class="box-title">There is not any employees!</h3>
                                            @endif

                                            </tfoot>
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
