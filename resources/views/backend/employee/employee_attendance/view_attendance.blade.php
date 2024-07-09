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

				  <h3 class="box-title">Employees` Attendance List</h3>
                  <a href="{{ route('employee.attendance.add') }}" style="float: right;" class="btn btn-rounded btn-success mb-5">Add Attendance</a>

				</div>
				<!-- /.box-header -->
				<div class="box-body">
					<div class="table-responsive">
					  <table id="example1" class="table table-bordered table-striped">
						<thead>
							@if ($datas->count())
                                <tr>
                                    <th>#</th>
                                    <th>Date</th>
                                    <th>Action</th>
                                </tr>
                            @endif
						</thead>
						<tbody>

							@if($datas->count())
                               @foreach ($datas as $id => $data)
                                <tr>
                                    <td width="10%">{{ $id+1 }}</td>
                                    <td>{{ date('d-m-Y', strtotime($data->date)) }}</td>
                                    <td width="35%">
										<a href="{{ route('employee.attendance.edit', $data->date) }}" class="btn btn-info">Edit</a> &nbsp;
                                        <a href="{{ route('employee.attendance.details', $data->date) }}" class="btn btn-primary">Details</a> &nbsp;
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