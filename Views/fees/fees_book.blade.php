@extends('includes.header')
@section('pageTitle', 'FeesBook')
@push('styles')
<style>
	.ex{
		padding-top: 10px;
		padding-bottom: 10px;
		padding-left: 15px;
		padding-right: 15px;
		margin-left: 10px;
	}
	.table-secondary{
		background-color: #c8d6e5;
	}
	
</style>
@endpush

@section('content')
<div class="row"> 

	<div class="card-body col-12">
		<div class="col-md-12 col-sm-12" >
			<div class="form-group row">
				<div class="col-sm-5 p-b-5">
					<input required class="form-control" type="number" min="0" maxlength="15" name="search"  id="search" placeholder="Student ID">
				</div>
				<div class="col-sm-2" >
					<button id="searchBtn" style="width: 100%;" type="button" class="btn waves-effect waves-light btn-outline-info "><i class="fas fa-search"></i>
					Search</button>
				</div>

				<div class="text-center col-sm-5">
					
					<button type="button" class="btn btn-outline-info btn-sm ex" id="print_page">Print</button>
				</div>
			</div>
		</div>
	</div>

	<div class="card-body" id="print">
		<div class="p-t-20 col-12 d-flex">
			<div class="col-6">
				<div class="form-group row">
					<label for="name" class="col-sm-6 control-label text-right">Name :
					</label>
					<div class="col-sm-6">
						<div class="controls">
							<label  name="student-name" id="student-name"></label>
						</div>
					</div>
				</div>
			</div>
			<!--/span-->
			<div class="col-6">
				<div class="form-group row">
					<label for="name" class="col-sm-6 control-label text-right">Student ID :
					</label>
					<div class="col-sm-6">
						<div class="controls">
							<label name="student-id" id="student-id"></label>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!--/span-->
		<div class="p-t-5 col-12 d-flex">
			<div class="col-6">
				<div class="form-group row">
					<label for="name" class="col-sm-6 control-label text-right">Class :
					</label>
					<div class="col-sm- 6">
						<div class="controls">
							<label  name="student-class" id="student-class"></label>
						</div>
					</div>
				</div>
			</div>
			<!--/span-->
			<div class="col-6">
				<div class="form-group row">
					<label for="name" class="col-sm-6 control-label text-right">Geder :
					</label>
					<div class="col-sm-6">
						<div class="controls">
							<label name="student-gender" id="student-gender"></label>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!--/span-->
		<div class="p-t-5 col-12 d-flex">
			<div class="col-6">
				<div class="form-group row">
					<label for="name" class="col-sm-6 control-label text-right">Section :
					</label>
					<div class="col-sm- 6">
						<div class="controls">
							<label  name="student-section" id="student-section"></label>
						</div>
					</div>
				</div>
			</div>
			<!--/span-->
			<div class="col-6">
				<div class="form-group row">
					<label for="name" class="col-sm-6 control-label text-right">Session :
					</label>
					<div class="col-sm-6">
						<div class="controls">
							<label name="student-session" id="student-session"></label>
						</div>
					</div>
				</div>
			</div>
		</div>

		<!-- Table -->
		<div class="col-lg-12">
			<div class="table-responsive" id="tableDiv">
				<table  class="table text-center table-bordered table-secondary " id="reportTable">
					<thead class="">
						<tr>
							<th >SL NO.</th>
							<th >Particular Name</th>
							<th >Amount (TK)</th>
						</tr>
					</thead>
					<tbody id="showValue">
					</tbody>
				</table>
			</div>
		</div>

	</div>

	


	




</div>



@endsection

@push('scripts')
<script src="{{asset('assets/js/jquery-ui.js')}}"></script>
<script src="{{asset('assets/plugins/table-button/dataTables.buttons.min.js')}}"></script>
<script src="{{asset('assets/plugins/table-button/buttons.flash.min.js')}}"></script>
<script src="{{asset('assets/plugins/table-button/jszip.min.js')}}"></script>
<script src="{{asset('assets/plugins/table-button/pdfmake.min.js')}}"></script>
<script src="{{asset('assets/plugins/table-button/vfs_fonts.js')}}"></script>
<script src="{{asset('assets/plugins/table-button/buttons.html5.min.js')}}"></script>
<script src="{{asset('assets/plugins/table-button/buttons.print.min.js')}}"></script>

<script src="https://cdn.jsdelivr.net/gh/linways/table-to-excel@v1.0.4/dist/tableToExcel.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.22/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.4.1/html2canvas.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.3.0/jspdf.umd.min.js"></script>


<script type="text/javascript">
	$(document).ready(function(){


		$('#searchBtn').click(function(event) {
			var studentId = document.getElementById("search").value;
			var toAppendItems = '<tr>';
			var totalTaka = 0;

			if(studentId ==""){
				showNotification("error", "Please input valid student Id and Try again.");
			}else{
				$.ajax({
					url: "{{ url('/feesBook') }}/"+studentId,
					type: 'GET',
					dataType: 'json',
					success:function(data) {
						$.each(data, function(index, val) {
							
							$('#student-name').text(val.name);
							$('#student-id').text(val.student_id);
							$('#student-class').text(val.class);
							$('#student-gender').text(val.gender);
							$('#student-section').text(val.section);
							$('#student-session').text(val.session);
							$.each(val.payment, function(index, valu) {
								console.log("data : "+valu.category);
								totalTaka += valu.amount;
								toAppendItems += '<td>'+(index+1)+'</td><td>'+valu.category+'</td><td>'+valu.amount+'</td></tr>'
							});
							toAppendItems += '<td>'+""+'</td><td>'+"Total "+'</td><td>'+totalTaka+'</td></tr>'

							$('#showValue').html(toAppendItems);

						});

					}
				});
			}

		});


		$('body').on('click', '#print_page', function() {
			printData();
		})


		function printData() {
			var printContents = document.getElementById("print").innerHTML;
			var originalContents = document.body.innerHTML;
			document.body.innerHTML = printContents;
			window.print();
			document.body.innerHTML = originalContents;
		}

	});

</script>
@endpush