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

				  <h3 class="box-title">Employee Attendance List</h3>
                  <a href="{{ route('employee.attendance.add') }}" style="float: right;" class="btn btn-rounded btn-info mb-5">Add Attendance</a>

				</div>
				<!-- /.box-header -->
				<div class="box-body">
					<div class="table-responsive">
					  <table id="example1" class="table table-bordered table-striped">
						<thead>
							@if ($datas->count())
                                <tr>
                                    <th>#</th>
                                    <th>Employee ID</th>
                                    <th>Employee Name</th>
                                    <th>Date</th>
                                    <th>Attend Status</th>
                                    <th>Action</th>
                                </tr>
                            @endif
						</thead>
						<tbody>

							@if($datas->count())
                               @foreach ($datas as $id => $data)
                                <tr>
                                    <td width="5%">{{ $id+1 }}</td>
                                    <td>{{ $data->user_id }}</td>
                                    <td>{{ $data->user_id }}</td>
                                    <td>{{ $data->user_id }}</td>
                                    <td>{{ $data }}</td>
                                    <td width="25%">
                                        <a href="{{ route('employee.leave.edit', $data->id) }}" class="btn btn-info">Edit</a> &nbsp;
                                    </td>
                                </tr>
                               @endforeach 
                            @else
                                <h3 class="box-title">There is no any attendances!</h3>
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