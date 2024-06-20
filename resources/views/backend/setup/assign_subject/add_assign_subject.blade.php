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
                        <h4 class="box-title">Add Assign Subject</h4>
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

                                <form method="post" action="{{ route('assign.subject.store') }}">
                                    @csrf

                                    <div class="add_item">
                                        <div class="row">
                                            <div class="col-12">

                                                <div class="form-group">
                                                    <h5>Student Class<span class="text-danger">*</span></h5>
                                                    <div class="controls">
                                                        <select name="class_id" id="class_id" class="form-control">
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
                                        </div>

                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <h5>Student Subject<span class="text-danger">*</span></h5>
                                                    <div class="controls">
                                                        <select name="subject_id[]" id="subject_id" class="form-control">
                                                            <option value="" selected disabled>Select Student Subject
                                                            </option>

                                                            @foreach ($subjects as $subject)
                                                                <option value="{{ $subject->id }}">{{ $subject->name }}
                                                                </option>
                                                            @endforeach

                                                        </select>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-2">
                                                <div class="form-group">
                                                    <h5>Full Mark <span class="text-danger">*</span></h5>
                                                    <div class="controls">
                                                        <input type="text" name="full_mark[]" required class="form-control">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-2">
                                                <div class="form-group">
                                                    <h5>Pass Mark <span class="text-danger">*</span></h5>
                                                    <div class="controls">
                                                        <input type="text" name="pass_mark[]" required class="form-control">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-2">
                                                <div class="form-group">
                                                    <h5>Subjective Mark <span class="text-danger">*</span></h5>
                                                    <div class="controls">
                                                        <input type="text" name="subjective_mark[]" required class="form-control">
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

                    <div class="col-md-4">
                        <div class="form-group">
                            <h5>Student Subject<span class="text-danger">*</span></h5>
                            <div class="controls">
                                <select name="subject_id[]" id="subject_id" class="form-control">
                                    <option value="" selected disabled>Select Student Subject
                                    </option>

                                    @foreach ($subjects as $subject)
                                        <option value="{{ $subject->id }}">{{ $subject->name }}
                                        </option>
                                    @endforeach

                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-2">
                        <div class="form-group">
                            <h5>Full Mark <span class="text-danger">*</span></h5>
                            <div class="controls">
                                <input type="text" name="full_mark[]" required class="form-control">
                            </div>
                        </div>
                    </div>

                    <div class="col-md-2">
                        <div class="form-group">
                            <h5>Pass Mark <span class="text-danger">*</span></h5>
                            <div class="controls">
                                <input type="text" name="pass_mark[]" required class="form-control">
                            </div>
                        </div>
                    </div>

                    <div class="col-md-2">
                        <div class="form-group">
                            <h5>Subjective Mark <span class="text-danger">*</span></h5>
                            <div class="controls">
                                <input type="text" name="subjective_mark[]" required class="form-control">
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
