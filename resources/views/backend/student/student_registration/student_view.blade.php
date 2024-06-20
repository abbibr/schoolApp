@extends('admin.admin_master')

@section('admin')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
	  <div class="container-full">

		<!-- Main content -->
		<section class="content">
		  <div class="row">

			<div class="col-12">
				<div class="box bb-3 border-warning">
					<div class="box-header">
					  <h4 class="box-title">Student <strong>Search</strong></h4>
					</div>
	
					<div class="box-body">
						<form action="{{ route('student.year.class.data') }}" method="GET">
							
							<div class="row">
								<div class="col-md-4">
									<div class="form-group">
										<h5>Year</h5>
										<div class="controls">
											<select name="year_id" id="year_id" class="form-control">
												<option value="" selected disabled>Select Year</option>

												@foreach ($years as $year)
													<option value="{{ $year->id }}" 
														{{ $year->id == $year_id ? 'selected' : '' }}
													>{{ $year->name }}
													</option>
												@endforeach

											</select>
										</div>
									</div>
								</div>

								<div class="col-md-4">
									<div class="form-group">
										<h5>Class</h5>
										<div class="controls">
											<select name="class_id" id="class_id" class="form-control">
												<option value="" selected disabled>Select Class</option>
											   
												@foreach ($classes as $class)
													<option value="{{ $class->id }}"
														{{ $class->id == $class_id ? 'selected' : '' }}
													>{{ $class->name }}
													</option>
												@endforeach
											</select>
										</div>
									</div>
								</div>

								<div class="col-md-4" style="padding-top: 25px;">
									<input type="submit" class="btn btn-rounded btn-dark mb-5" 
									name="search" value="Search">
								</div>


							</div>
						</form>
					</div>
				  </div>
			</div>

			<div class="col-12">

			 <div class="box">
				<div class="box-header with-border">

				  <h3 class="box-title">Student List</h3>
                  <a href="{{ route('student.registration.add') }}" style="float: right;" class="btn btn-rounded btn-info mb-5">Add Student</a>

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
                                <th>Role</th>
                                <th>Year</th>
                                <th>Class</th>
                                <th>Image</th>
								@if (auth()->user()->role == 'admin')
									<th>Code</th>
								@endif
								<th>Action</th>
							</tr>
						</thead>
						<tbody>

							@if($datas->count())
                               @foreach ($datas as $id => $data)
                                <tr>
                                    <td width="5%">{{ $id+1 }}</td>
                                    <td>{{ $data->student->name }}</td>
                                    <td>{{ $data->student->id_no }}</td>
                                    <td>{{ $data->roll }}</td>
                                    <td>{{ $data->year->name }}</td>
                                    <td>{{ $data->class->name }}</td>
                                    <td>
										<img width="80px" height="80px" style="border-radius: 100%;" src="{{ asset('storage/'.$data->student->image) }}">
									</td>
                                    
									@if (auth()->user()->role == 'admin')
										<td>
											{{ $data->student->code }}
										</td>
									@endif

                                    <td width="25%">
                                        <a href="{{ route('student.registration.edit', $data->id) }}" class="btn btn-info" title="Edit">
											<i class="fa fa-edit"></i>
										</a> &nbsp;
                                        <a href="{{ route('student.registration.details', $data->id) }}" class="btn btn-primary" title="Details">
											<i class="fa fa-eye"></i>
										</a>
                                    </td>
                                </tr>
                               @endforeach 
                            @else
                                <h3 class="box-title">There is not any student in this category!</h3>
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