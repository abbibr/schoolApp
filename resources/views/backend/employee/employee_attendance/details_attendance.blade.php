@extends('admin.admin_master')

@section('admin')

	<style>
		.green {
			color: rgb(20, 223, 20);
		}
		.red {
			color: rgb(232, 19, 19);
		}
		.yellow {
			color: yellow;
		}
	</style>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
	  <div class="container-full">

		<!-- Main content -->
		<section class="content">
		  <div class="row">

			<div class="col-12">

			 <div class="box">
				<div class="box-header with-border">
				  <h3 class="box-title">Employees` Attendance of {{ date('d/M/Y', strtotime($dateAttendances[0]->date)) }}</h3>
				  <a href="{{ route('employee.attendance.view') }}" style="float: right;" class="btn btn-rounded btn-success mb-5">Back to View Page</a>
				</div>
				<!-- /.box-header -->
				<div class="box-body">
					<div class="table-responsive">
					  <table id="example1" class="table table-bordered table-striped">
						<thead>
							<tr>
								<th>#</th>
								<th>Employee ID</th>
								<th>Employee Name</th>
								<th>Employee Phone</th>
								<th>Attendance</th>
							</tr>
						</thead>
						<tbody>

							@foreach ($dateAttendances as $key => $value)
                                <tr>
                                    <td style="font-size: 17px;" width="5%">{{ $key+1 }}</td>
                                    <td style="font-size: 17px;">{{ $value->employee->id_no }}</td>
                                    <td style="font-size: 17px;">{{ $value->employee->name }}</td>
                                    <td style="font-size: 17px;">{{ $value->employee->mobile }}</td>
                                    <td style="font-size: 17px;" class="{{ ($value->attend_status == "present") ? "green" : ($value->attend_status == "absent" ? 'yellow' : 'red') }}">
										{{ Str::ucfirst($value->attend_status) }}
									</td>
                                </tr>
                            @endforeach 

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