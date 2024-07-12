@extends('admin.admin_master')

@section('admin')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <div class="container-full">

            <!-- Main content -->
            <section class="content">
                <div class="row">

                    <div class="col-12">
                        <div class="box bb-3 border-warning">
                            <div class="box-header">
                                <h4 class="box-title">Student <strong>Entry Marks</strong></h4>
                            </div>

                            <div class="box-body">
                                <form method="get" action="">

                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <h5>Year</h5>
                                                <div class="controls">
                                                    <select name="year_id" id="year_id" class="form-control">
                                                        <option value="" selected disabled>Select Year</option>

                                                        @foreach ($years as $year)
                                                            <option value="{{ $year->id }}">{{ $year->name }}
                                                            </option>
                                                        @endforeach

                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <h5>Class</h5>
                                                <div class="controls">
                                                    <select name="class_id" id="class_id" class="form-control">
                                                        <option value="" selected disabled>Select Class</option>

                                                        @foreach ($classes as $class)
                                                            <option value="{{ $class->id }}">{{ $class->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <h5>Subject</h5>
                                                <div class="controls">
                                                    <select name="assign_subject_id" id="assign_subject_id" class="form-control">
                                                        <option selected>Select Subject</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-3" style="padding-top: 25px;">
                                            <a id="search" name="search" class="btn btn-primary">Search</a>
                                        </div>

                                    </div>

                                    {{-- Role Generator --}}

                                    <div class="row d-none" id="roll-generate">
                                        <div class="col-md-12">
                                            <table class="table table-bordered table-striped" style="width: 100%;">
                                                <thead id="roll-generate-th">
                                                    <tr> 
                                                        <th>ID No</th>
                                                        <th>Student Name</th>
                                                        <th>Father Name</th>
                                                        <th>Mother Name</th>
                                                        <th>Student Gender</th>
                                                        <th>Role</th>
                                                    </tr>
                                                </thead>

                                                <tbody id="roll-generate-tr">

                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </section>
            <!-- /.content -->

        </div>
    </div>

    <script type="text/javascript">
        $(document).on('click', '#search', function() {
            var year_id = $('#year_id').val();
            var class_id = $('#class_id').val();
            $.ajax({
                type: "GET",
                url: "{{ route('student.role.generate') }}",
                dataType: 'json',
                data: {
                    'year_id': year_id,
                    'class_id': class_id
                },
                success: function(data) {
                    $('#roll-generate').removeClass('d-none');
                    var html = '';
                    $.each(data, function(key, v) {
                        html +=
                            '<tr>' +
                            '<td>' + v.student.id_no +
                            '<input type="hidden" name="student_id[]" value="' + v.student_id +
                            '"></td>' +
                            '<td>' + v.student.name + '</td>' +
                            '<td>' + v.student.fname + '</td>' +
                            '<td>' + v.student.mname + '</td>' +
                            '<td>' + v.student.gender + '</td>' +
                            '<td><input type="text" class="form-control form-control-sm" name="roll[]" value="' +
                            v.roll + '"></td>' +
                            '</tr>';
                    });
                    html = $('#roll-generate-tr').html(html);
                },
                error: function(data) {
                    console.log(data);
                }
            });
        });
    </script>

    <script type="text/javascript">
        $(function(){
            $(document).on('change','#class_id',function(){
                var class_id = $('#class_id').val();
                $.ajax({
                url:"{{ route('marks.entry.subject') }}",
                type:"GET",
                data:{class_id:class_id},
                success:function(data){
                    var html = '<option value="">Select Subject</option>';
                    $.each( data, function(key, v) {
                    html += '<option value="'+v.id+'">'+v.school_subject.name+'</option>';
                    });
                    $('#assign_subject_id').html(html);
                }
                });
            });
        });
    </script>
@endsection
