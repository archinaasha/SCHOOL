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
                        <h3 class="m-b-0 text-white">Show All Payment Category List</h3>
                    </div>
                    <div class="ml-auto">
                        <button id="addBtn" type="button" class="addBtn btn waves-effect waves-light btn-outline-light">
                        Add New Category</button>

                    </div>
                </div>
            </div>

            <!-- show Student div start bellow -->
            <div class="card-body">
                <div class="table-responsive">
                    <table id="paymentList" class="p-l-0 p-r-0 table table-bordered table-striped">
                        <thead>
                            <tr>
                             <th>Student ID</th>
                             <th>Payment Name</th>
                             <th>Amount (TK)</th>
                             <th width="5%">Action</th>
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
                <h4 class="modal-title" >Are you sure to delete this Category?</h4>
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
                                 <div class="col-md-12">
                                    <div class="form-group row">
                                        <label for="name" class="col-sm-3 control-label">Student ID :<span
                                            class="text-danger">*</span></label>
                                            <div class="col-sm-9">
                                                <div class="controls">
                                                    <input required type="number" min="0" maxlength="15" name="student_id" class="form-control" id="student_id"
                                                    placeholder="Student ID"  oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"
                                                    onKeyUp="if(this.value<0){this.value='0';}">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!--/span-->
                                    <div class="col-md-12">
                                        <div class="form-group row">
                                            <label for="name" class="col-sm-3 control-label">New Category :<span
                                                class="text-danger">*</span></label>
                                                <div class="col-sm-9">
                                                    <div class="controls">
                                                        <input type="text" maxlength="60" name="category" class="form-control" id="category"
                                                        placeholder="Payment Category" required>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!--/span-->
                                        <div class="col-12">
                                            <div class="form-group row">
                                                <label class="col-sm-3 control-label">Amount (TK) : <span
                                                    class="text-danger">*</span></label>
                                                    <div class="col-sm-9">
                                                        <div class="controls">
                                                            <input required type="number" min="0" maxlength="15" name="amount" class="form-control" id="amount"
                                                            oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"
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
        url: "{{ url('/add-payment_category') }}",
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
 var table = $('#paymentList').DataTable({
    processing: true,
    serverSide: true,
    ajax: {
        url: "{{ url('payment_categoryDataTable') }}",
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
        data: 'category',
        name: 'category'
    },
    {
        data: 'amount',
        name: 'amount'
    },
    {
        data: 'action',
        name: 'action',
        orderable: false,
        searchable: false
    },
    ]

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
    $.post("{{ url('/payment_categoryDelete') }}", {
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