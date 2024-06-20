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

				  <h3 class="box-title">{{ $datas[0]->student_class->name }} Details:</h3>
                  <a href="{{ route('assign.subject.view') }}" style="float: right;" class="btn btn-rounded btn-info mb-5">Back to Assign View Page</a>

				</div>
				<!-- /.box-header -->
				<div class="box-body">
					<div class="table-responsive">
					  <table id="example1" class="table table-bordered table-striped">
						<thead>
							<tr>
								<th>#</th>
                                <th>School Subject</th>
                                <th>Full Mark</th>
                                <th>Pass Mark</th> 
								<th>Subjective Mark</th>
							</tr>
						</thead>
						<tbody>

							@foreach ($datas as $key => $data)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $data->school_subject->name }}</td>
                                    <td>{{ $data->full_mark }}</td>
                                    <td>{{ $data->pass_mark }}</td>
                                    <td>{{ $data->subjective_mark }}</td>
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