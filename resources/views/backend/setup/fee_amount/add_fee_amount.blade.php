@extends('admin.admin_master')

@section('admin')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <div class="container-full">
            <section class="content">

                <!-- Basic Forms -->
                <div class="box">
                    <div class="box-header with-border">
                        <h4 class="box-title">Add Fee Category Amount</h4>
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

                                <form method="post" action="{{ route('fee.amount.store') }}">
                                    @csrf

                                    <div class="add_item">
                                        <div class="row">
                                            <div class="col-12">

                                                <div class="form-group">
                                                    <h5>Fee Category<span class="text-danger">*</span></h5>
                                                    <div class="controls">
                                                        <select name="category_id" id="category_id" class="form-control">
                                                            <option value="" selected disabled>Select Fee Category
                                                            </option>

                                                            @foreach ($categories as $category)
                                                                <option value="{{ $category->id }}">{{ $category->name }}
                                                                </option>
                                                            @endforeach

                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-5">
                                                <div class="form-group">
                                                    <h5>Student Class<span class="text-danger">*</span></h5>
                                                    <div class="controls">
                                                        <select name="class_id[]" id="class_id" class="form-control">
                                                            <option value="" selected disabled>Select Student Class
                                                            </option>

                                                            @foreach ($classes as $class)
                                                                <option value="{{ $class->id }}">{{ $class->name }}
                                                                </option>
                                                            @endforeach

                                                        </select>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-5">
                                                <div class="form-group">
                                                    <h5>Fee Amount (sum) <span class="text-danger">*</span></h5>
                                                    <div class="controls">
                                                        <input type="text" name="amount[]" required class="form-control">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-2" style="padding: 25px;">
                                                <span class="btn btn-success addEventMore">
                                                    <i class="fa fa-plus-circle"></i>
                                                </span>
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

    <div style="visibility: hidden;">
        <div class="whole_extra_item_add" id="whole_extra_item_add">
            <div class="delete_whole_extra_item_add" id="delete_whole_extra_item_add">
                <div class="form-row">
                    <div class="col-md-5">
                        <div class="form-group">
                            <h5>Student Class<span class="text-danger">*</span></h5>
                            <div class="controls">
                                <select name="class_id[]" id="class_id" class="form-control">
                                    <option value="" selected disabled>Select Student Class</option>

                                    @foreach ($classes as $class)
                                        <option value="{{ $class->id }}">{{ $class->name }}</option>
                                    @endforeach

                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-5">
                        <div class="form-group">
                            <h5>Fee Amount (sum) <span class="text-danger">*</span></h5>
                            <div class="controls">
                                <input type="text" name="amount[]" class="form-control">
                            </div>
                        </div>
                    </div>

                    <div class="col-md-2" style="padding: 25px;">
                        <span class="btn btn-success addEventMore">
                            <i class="fa fa-plus-circle"></i>
                        </span>
                        <span class="btn btn-danger removeEventMore">
                            <i class="fa fa-minus-circle"></i>
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            var counter = 0;

            $(document).on('click', '.addEventMore', function() {
                var whole_extra_item_add = $('#whole_extra_item_add').html();
                $(this).closest('.add_item').append(whole_extra_item_add);
                counter++;
            });

            $(document).on('click', '.removeEventMore', function() {
                $(this).closest('.delete_whole_extra_item_add').remove();
                counter -= 1;
            });
        });
    </script>

@endsection
