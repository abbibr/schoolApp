@extends('admin.admin_master')

@section('admin')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
	  <div class="container-full">
		<!-- Content Header (Page header) -->
		<div class="content-header">
			<div class="d-flex align-items-center">
				<div class="mr-auto">
					<h3 class="page-title">Assign Subject Table</h3>
					<div class="d-inline-block align-items-center">
						<nav>
							<ol class="breadcrumb">
								<li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i class="mdi mdi-home-outline"></i></a></li>
								<li class="breadcrumb-item" aria-current="page">Tables</li>
								<li class="breadcrumb-item active" aria-current="page">Assign Subject</li>
							</ol>
						</nav>
					</div>
				</div>
			</div>
		</div>

		<!-- Main content -->
		<section class="content">
		  <div class="row">

			<div class="col-12">

			 <div class="box">
				<div class="box-header with-border">

				  <h3 class="box-title">Assign Subject List</h3>
                  <a href="{{ route('assign.subject.add') }}" style="float: right;" class="btn btn-rounded btn-info mb-5">Add Assign Subject</a>

				</div>
				<!-- /.box-header -->
				<div class="box-body">
					<div class="table-responsive">
					  <table id="example1" class="table table-bordered table-striped">
						<thead>
							<tr>
								<th>#</th>
                                <th>Student Class Name</th>
								<th>Action</th>
							</tr>
						</thead>
						<tbody>

							@if($datas->count())
                               @foreach ($datas as $id => $assign)
                                <tr>
                                    <td width="5%">{{ $id+1 }}</td>
                                    <td>{{ $assign->student_class->name }}</td>
                                    <td width="25%">
                                        <a href="{{ route('assign.subject.edit', $assign->class_id) }}" class="btn btn-info">Edit</a> &nbsp;
                                        <a href="{{ route('assign.subject.details', $assign->class_id) }}" class="btn btn-primary">Details</a>
                                    </td>
                                </tr>
                               @endforeach 
                            @else
                                <h3 class="box-title">There is not any assign subjects!</h3>
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