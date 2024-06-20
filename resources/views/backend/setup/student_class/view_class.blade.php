@extends('admin.admin_master')

@section('admin')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
	  <div class="container-full">
		<!-- Content Header (Page header) -->
		<div class="content-header">
			<div class="d-flex align-items-center">
				<div class="mr-auto">
					<h3 class="page-title">Student Classes Table</h3>
					<div class="d-inline-block align-items-center">
						<nav>
							<ol class="breadcrumb">
								<li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i class="mdi mdi-home-outline"></i></a></li>
								<li class="breadcrumb-item" aria-current="page">Tables</li>
								<li class="breadcrumb-item active" aria-current="page">Student Classes</li>
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

				  <h3 class="box-title">Student Classes</h3>
                  <a href="{{ route('student.class.add') }}" style="float: right;" class="btn btn-rounded btn-info mb-5">Add Student Class</a>

				</div>
				<!-- /.box-header -->
				<div class="box-body">
					<div class="table-responsive">
					  <table id="example1" class="table table-bordered table-striped">
						<thead>
							<tr>
								<th>#</th>
                                <th>Name</th>
								<th>Action</th>
							</tr>
						</thead>
						<tbody>

							@if($datas->count())
                               @foreach ($datas as $id => $data)
                                <tr>
                                    <td width="5%">{{ $id+1 }}</td>
                                    <td>{{ $data->name }}</td>
                                    <td width="25%">
                                        <a href="{{ route('student.class.edit', $data->id) }}" class="btn btn-info">Edit</a> &nbsp;
                                        <a href="{{ route('student.class.delete', $data->id) }}" class="btn btn-danger" id="delete">Delete</a>
                                    </td>
                                </tr>
                               @endforeach 
                            @else
                                <h3 class="box-title">There is not any student classes!</h3>
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