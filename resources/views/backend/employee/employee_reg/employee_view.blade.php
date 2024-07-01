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

                                <h3 class="box-title">Employee List</h3>
                                <a href="{{ route('employee.registration.add') }}" style="float: right;"
                                    class="btn btn-rounded btn-info mb-5">Add Employee</a>
                                <a href="{{ route('employee.registration.lists') }}" style="margin-left: 10px;"
                                    class="btn btn-rounded btn-success mb-5">Employees Lists</a>

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
                                                @if (auth()->user()->role == 'admin')
                                                    <th>Code</th>
                                                @endif
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
                                                        <td>{{ $data->join_date }}</td>
                                                        <td>{{ $data->salary }}</td>
                                                        @if (auth()->user()->role == 'admin')
                                                            <td>{{ $data->code }}</td>
                                                        @endif
                                                        <td width="25%">
                                                            <a href="{{ route('employee.registration.edit', $data->id) }}"
                                                                class="btn btn-info">Edit</a> &nbsp;
                                                            <a href="{{ route('employee.registration.delete', $data->id) }}"
                                                                class="btn btn-danger" id="delete">Delete</a>
                                                            <a href="{{ route('employee.registration.details', $data->id) }}"
                                                                class="btn btn-primary">Details</a>
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
