@extends('admin.admin_master')

@section('admin')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <div class="container-full">
            <section class="content">

                <!-- Basic Forms -->
                <div class="box">
                    <div class="box-header with-border">
                        <h4 class="box-title">Employee Salary Increment</h4>
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

                                <form method="post" action="{{ route('employee.increment.update', $edit->id) }}">
                                    @csrf

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <h5>Salary Amount <span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <input type="text" name="increment_salary" class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <h5>Effected Date <span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <input type="date" name="effected_salary" class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="text-xs-right">
                                        <input type="submit" class="btn btn-rounded btn-primary" value="Update Salary">
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
