@extends('includes.header')
@section('pageTitle', 'User')

@push('styles')
<style>
</style>
@endpush

@section('content')
<div class="row">

	<div class="col-12">
		<div class="card">
			<div class="card-header bg-info">
				<div class="d-flex">
					<div class="align-self-center">
						<h3 class="m-b-0 text-white">Show All Student List</h3>
					</div>
					<div class="ml-auto">
						<button id="addBtn" type="button" class="addBtn btn waves-effect waves-light btn-outline-light">
						Add New Student</button>

					</div>
				</div>
			</div>

			<!-- show Student div start bellow -->
			<div class="card-body">
				<div class="table-responsive">
					<table id="studentList" class="p-l-0 p-r-0 table table-bordered table-striped">
						<thead>
							<tr>
								<th>Student ID</th>
								<th>First Name</th>
								<th>Last Name</th>
								<th>Gender</th>
								<th>Date of Birth</th>
								<th>Present Address</th>
								<th>SMS No.</th>
								<th>Session</th>
								<th>Class</th>
								<th>Group</th>
								<th>Class Section</th>
								<th>Roll</th>
								<th width="10%">Action</th>
							</tr>
						</thead>
						<tbody>
							<!-- dynamic table will be load here -->
						</tbody>
					</table>
				</div>
			</div>
			<!-- show Student div end here -->
		</div>
	</div>

	

</div>


<!-- /delete User modal -->
<div id="deleteModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="tooltipmodel" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title" >Are you sure to delete this Referral?</h4>
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn waves-effect waves-light btn-outline-danger"
				data-dismiss="modal">Cancel</button>
				<button id="delete_yes" type="button" class="btn waves-effect waves-light btn-danger"
				data-dismiss="modal">Confirm</button>
			</div>
		</div> 
	</div>                    
</div>
<!-- /end delete modal --> 


<!-- /add Referral modal -->
<div id="addModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="tooltipmodel" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered modal-lg">
		<div class="modal-content">
			<div class="modal-header bg-info">
				<h4 class="modal-title text-white" id="modalHeader"></h4>
				<button type="button" class="close white" data-dismiss="modal" aria-hidden="true">×</button>
			</div>

			<div class="modal-body">
				<div class="col-12">
					<div class="card">

						<form id="addForm">
							<input type="hidden" name="edit_id" id="edit_id">
							<div class="form-body">
								{{ csrf_field() }}
								
								<div class="row p-t-20">
									<div class="col-12">
										<div class="form-group row">
											<label for="name" class="col-sm-3 control-label">Student ID :
											</label>
											<div class="col-sm-9">
												<div class="controls">
													<input  name="student_id" class="form-control no-drop" id="student_id" readonly>
												</div>
											</div>
										</div>
									</div>
									<!--/span-->
									<div class="col-md-12">
										<div class="form-group row">
											<label for="name" class="col-sm-3 control-label">First Name :<span
												class="text-danger">*</span></label>
												<div class="col-sm-9">
													<div class="controls">
														<input type="text" maxlength="60" name="fname" class="form-control" id="fname"
														placeholder="First Name" required>
													</div>
												</div>
											</div>
										</div>
										<!--/span-->

										<div class="col-md-12">
											<div class="form-group row">
												<label for="name" class="col-sm-3 control-label">Last Name :<span
													class="text-danger">*</span></label>
													<div class="col-sm-9">
														<div class="controls">
															<input type="text" maxlength="60" name="lname" class="form-control" id="lname"
															placeholder="Last Name" required>
														</div>
													</div>
												</div>
											</div>
											<!--/span-->
											<div class="col-12">
												<div class="form-group row">
													<label  class="col-sm-3 control-label">Gender :<span
														class="text-danger">*</span></label>
														<div class="col-sm-9">
															<div class="controls">
																<select class="form-control" name="gender" id="gender"  required>
																	<option value="">Select</option>
																	<option value="Male">Male</option>
																	<option value="Female">Female</option>
																	<option value="Other">Other</option>
																</select> 
															</div>
														</div>
													</div>
												</div>
												<!--/span-->
												<div class="col-md-12">
													<div class="form-group row">
														<label for="name" class="col-sm-3 control-label">Date of Birth :<span
															class="text-danger">*</span></label>
															<div class="col-sm-9">
																<div class="controls">
																	<input type="text" maxlength="60" name="date_of_birth" class="form-control" id="date_of_birth"
																	placeholder="Date-of-Birth" required>
																</div>
															</div>
														</div>
													</div>
													<!--/span-->
													<div class="col-12">
														<div class="form-group row">
															<label for="phone" class="col-sm-3 control-label">Present Address :<span
																class="text-danger">*</span>
															</label>
															<div class="col-sm-9">
																<div class="controls">
																	<textarea type="text" name="address" rows="2"  class="form-control" id="address"  required></textarea>
																	<p id="p_d_wordCount" class="text-right word_count_p" ></p>
																</div>
															</div>
														</div>
													</div>

													<!--/span-->
													<div class="col-12">
														<div class="form-group row">
															<label class="col-sm-3 control-label">SMS No. : <span
																class="text-danger">*</span></label>
																<div class="col-sm-9">
																	<div class="controls">
																		<input required type="number" min="0" maxlength="15" name="sms" class="form-control" id="sms"
																		placeholder="SMS No."  oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"
																		onKeyUp="if(this.value<0){this.value='0';}">
																	</div>
																</div>
															</div>
														</div>
														<!--/span-->
														<div class="col-md-12">
															<div class="form-group row">
																<label for="name" class="col-sm-3 control-label">Session :<span
																	class="text-danger">*</span></label>
																	<div class="col-sm-9">
																		<div class="controls">
																			<input type="text" maxlength="60" name="session" class="form-control" id="session"
																			placeholder="Session" required>
																		</div>
																	</div>
																</div>
															</div>
															<!--/span-->
															<div class="col-12">
																<div class="form-group row">
																	<label  class="col-sm-3 control-label">Class :<span
																		class="text-danger">*</span></label>
																		<div class="col-sm-9">
																			<div class="controls">
																				<select class="form-control" name="class" id="class"  required>
																					<option value="">Select</option>
																					<option value="VI">VI</option>
																					<option value="VII">VII</option>
																					<option value="VIII">VIII</option>
																					<option value="IX">IX</option>
																					<option value="X">X</option>
																				</select> 
																			</div>
																		</div>
																	</div>
																</div>
																<!--/span-->
																<div class="col-12">
																	<div class="form-group row">
																		<label  class="col-sm-3 control-label">Group :<span
																			class="text-danger">*</span></label>
																			<div class="col-sm-9">
																				<div class="controls">
																					<select class="form-control" name="s_group" id="s_group"  required>
																						<option value="">Select</option>
																						<option value="N/A">N/A</option>
																						<option value="Science">Science</option>
																						<option value="Business Studies">Business Studies</option>
																						<option value="Humanities">Humanities</option>
																					</select> 
																				</div>
																			</div>
																		</div>
																	</div>
																	<!--/span-->
																	<div class="col-12">
																		<div class="form-group row">
																			<label  class="col-sm-3 control-label">Class Section :<span
																				class="text-danger">*</span></label>
																				<div class="col-sm-9">
																					<div class="controls">
																						<select class="form-control" name="section" id="section"  required>
																							<option value="">Select</option>
																							<option value="A">A</option>
																							<option value="B">B</option>
																							<option value="C">C</option></select> 
																							
																						</div>
																					</div>
																				</div>
																			</div>

																			<!--/span-->
																			<div class="col-12">
																				<div class="form-group row">
																					<label class="col-sm-3 control-label">Roll : <span
																						class="text-danger">*</span></label>
																						<div class="col-sm-9">
																							<div class="controls">
																								<input required type="number" min="0" maxlength="15" name="roll" class="form-control" id="roll"
																								placeholder="Roll"  oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"
																								onKeyUp="if(this.value<0){this.value='0';}">
																							</div>
																						</div>
																					</div>
																				</div>	

																			</div>	

																			<hr>
																			<div class="form-actions text-right">
																				<button type="button" class="btn waves-effect waves-light btn-outline-danger"
																				data-dismiss="modal">Cancel</button>

																				<button id="add_save_btn" type="submit" class="waves-effect waves-light btn btn-info" > <i class="fa fa-check"> </i> Save</button>
																			</div>
																		</div>
																	</form>

																</div>
															</div>
														</div>
													</div>
												</div>

												<!-- /end modal -->

												@endsection


												@push('scripts')

												<script src="{{asset('/assets/js/jquery-ui.js')}}"></script>
												<script src="{{asset('/assets/plugins/inputmask/dist/min/jquery.inputmask.bundle.min.js')}}"></script>
												<script src="{{asset('/assets/plugins/table-button/dataTables.buttons.min.js')}}"></script>
												<script src="{{asset('/assets/plugins/table-button/buttons.flash.min.js')}}"></script>
												<script src="{{asset('/assets/plugins/table-button/jszip.min.js')}}"></script>
												<script src="{{asset('/assets/plugins/table-button/pdfmake.min.js')}}"></script>
												<script src="{{asset('/assets/plugins/table-button/vfs_fonts.js')}}"></script>
												<script src="{{asset('/assets/plugins/table-button/buttons.html5.min.js')}}"></script>
												<script src="{{asset('/assets/plugins/table-button/buttons.print.min.js')}}"></script>

												<script type="text/javascript">
													$(document).ready(function(){

												// add button click
												$('#addBtn').click(function(event) {
													$('#modalHeader').html('Add New Catagory');
													$('#edit_id').val('');
													$('#addForm')[0].reset();
													$('#addModal').modal('show');
												});


											// add student
											$("#addForm").on('submit', function(event) {
												event.preventDefault();

												var form_data = document.getElementById("addForm");
												var fd = new FormData(form_data);

												$.ajax({
													url: "{{ url('/add-student') }}",
													data: fd,
													cache: false,
													processData: false,
													contentType: false,
													type: 'POST',
													success: function(data) {
														if (data.result == "success") {
															$('#addModal').modal('hide');
															table.ajax.reload(null, false);
															showNotification(data.result, data.message);
														} else {
															showNotification(data.result, data.message);
														}
													}
												});

											});

						// table
						var table = $('#studentList').DataTable({
							processing: true,
							serverSide: true,
							ajax: {
								url: "{{ url('studentDataTable') }}",
								type: 'GET',
							},
							"order": [
							[0, 'asc']
							],
							columns: [
							{
								data: 'student_id',
								name: 'student_id'
							},
							{
								data: 'fname',
								name: 'fname'
							},
							{
								data: 'lname',
								name: 'lname'
							},
							{
								data: 'gender',
								name: 'gender'
							},
							{
								data: 'date_of_birth',
								name: 'date_of_birth'
							},
							{
								data: 'address',
								name: 'address'
							},
							{
								data: 'sms',
								name: 'sms'
							},
							{
								data: 'session',
								name: 'session'
							},
							{
								data: 'class',
								name: 'class'
							},
							{
								data: 's_group',
								name: 's_group'
							},
							{
								data: 'section',
								name: 'section'
							},
							{
								data: 'roll',
								name: 'roll'
							},

							{
								data: 'action',
								name: 'action',
								orderable: false,
								searchable: false
							},
							],
							dom: 'Bfrtip',
							buttons: [
							{
								extend: 'csv',
								exportOptions: {
									columns: [ 0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11 ]
								}
							},

							{
								extend: 'print',
								exportOptions: {
									columns: [ 0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11 ] 
								}
							},
							{
								extend: 'pdf',
								exportOptions: {
									columns: [ 0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11 ] 
								}
							}
							]
						});



	// update
	$('body').on('click', '.editData', function(event) {
		var row_id = $(this).data('id');
		$('#edit_id').val(row_id);
		$('#modalHeader').html('Edit Student Information');

		$.get("{{ url('/getstudentById') }}/"+row_id, function(data) {

			$('#addModal').modal('show');

			var data = $.parseJSON(data);

			$('#student_id').val(data[0].student_id);
			$('#fname').val(data[0].fname);
			$('#lname').val(data[0].lname);
			$('#gender').val(data[0].gender);
			$('#date_of_birth').val(data[0].date_of_birth);
			$('#address').val(data[0].address);
			$('#sms').val(data[0].sms);
			$('#session').val(data[0].session);
			$('#class').val(data[0].class);
			$('#s_group').val(data[0].s_group);
			$('#section').val(data[0].section);
			$('#roll').val(data[0].roll);
		});


	});



// delete data
var row_id = "";
$('body').on('click', '.deleteData', function() {
	row_id = $(this).data('id');
	$('#deleteModal').modal('show');
	console.log(row_id);
});

// delete yes click
$("#delete_yes").click(function(event) {
	$.post("{{ url('/studentDelete') }}", {
		"_token": "{{ csrf_token() }}",
		'id': row_id,
	},
	function(data, textStatus, xhr) {
		if (data.result == "success") {
			showNotification(data.result, data.message);
			table.ajax.reload(null, false);
		} else  {
			showNotification(data.result, data.message);
		}
	});
});


function showNotification(type, message) {
	$.toast({
		heading: message,
		position: 'bottom-right',
		loaderBg: '#ff6849',
		icon: type,
		hideAfter: 3000,
		stack: 1
	});
}

});
</script>
@endpush




