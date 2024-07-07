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

				  <h3 class="box-title">Employee Leave</h3>
                  <a href="{{ route('employee.leave.add') }}" style="float: right;" class="btn btn-rounded btn-info mb-5">Add Employee Leave</a>

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
                                    <th>Purpose of leaving</th>
                                    <th>Start Date</th>
                                    <th>End Date</th>
                                    <th>Action</th>
                                </tr>
                            @endif
						</thead>
						<tbody>

							@if($datas->count())
                               @foreach ($datas as $id => $data)
                                <tr>
                                    <td width="5%">{{ $id+1 }}</td>
                                    <td>{{ $data->employee->id_no }}</td>
                                    <td>{{ $data->employee->name }}</td>
                                    <td>{{ $data->purpose->name }}</td>
                                    <td>{{ $data->start_date }}</td>
                                    <td>{{ $data->end_date }}</td>
                                    <td width="25%">
                                        <a href="{{ route('employee.leave.edit', $data->id) }}" class="btn btn-info">Edit</a> &nbsp;
                                        <a href="{{ route('designation.delete', $data->id) }}" class="btn btn-danger" id="delete">Delete</a>
                                    </td>
                                </tr>
                               @endforeach 
                            @else
                                <h3 class="box-title">There is no any left employee!</h3>
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