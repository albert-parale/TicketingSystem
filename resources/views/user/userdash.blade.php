@extends('layouts.app')


@section('content')

@include('layouts.tablenavbaruser')
<!-- Start Datatable -->
<div class="container mt-1">
    <div class="row mt-5">
        <h3 class="text">Create your tickets</h3>
        <button class="btn btn-success mb-3" style="margin-left: 690px;" id="btnCreateTick">Create Tickets</button>
    </div>
    <table id="viewtable" class="table table-bordered data-table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Created by</th>
                <th>Ticket Description</th>
                <th>Importance</th>
                <th>Status</th>
                <th>Submitted at</th>
                <th width="100px">Action</th>
            </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
</div>
<!-- End Datatable -->

<!-- Start Add Ticket Modal -->
<div class="modal fade" id="CreateTicket" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Create Tickets</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form>
                    
                    <div class="form-group">
                        <label for="created_by" class="col-form-label">Created By</label>
                        <input type="text" class="form-control" id="created_by" value="Client" disabled>
                    </div>
                    <div class="form-group">
                        <label for="firstname" class="col-form-label">Ticket Description</label>
                        <textarea class="form-control" id="ticket_desc"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="firstname" class="col-form-label">Importance</label>
                        <select class="form-control" id="importance" name="importance">
                            <option>Select One</option>
                            <option>Urgent</option>
                            <option>Mid</option>
                            <option>Low</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="firstname" class="col-form-label">Status</label>
                        <input type="text" class="form-control" id="status" value="Open" disabled>
                    </div>
                    <div class="form-group">
                        <label for="lastname" class="col-form-label">Submitted At</label>
                        <input type="date" class="form-control" id="created_at">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" id="btnAdd" class="btn btn-primary">Submit</button>
            </div>
        </div>
    </div>
 </div>
<!-- End Add Ticket Modal -->

<!-- Start View Ticket Modal -->
<div class="modal fade" id="ViewTicket" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="staticBackdropLabel">View Tickets</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form>
                <input type="text" id="view_id" hidden>
                <form>
                    <form>
                    <div class="form-group">
                        <label for="created_by" class="col-form-label">Created By</label>
                        <input type="text" class="form-control" id="ucreated_by" value="Client" disabled>
                    </div>
                    <div class="form-group">
                        <label for="firstname" class="col-form-label">Ticket Description</label>
                        <textarea class="form-control" id="uticket_desc"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="firstname" class="col-form-label">Importance</label>
                        <select class="form-control" id="uimportance" name="importance">
                            <option>Select One</option>
                            <option>Urgent</option>
                            <option>Mid</option>
                            <option>Low</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="firstname" class="col-form-label">Status</label>
                        <input type="text" class="form-control" id="ustatus" value="Open" disabled>
                    </div>
                    <div class="form-group">
                        <label for="lastname" class="col-form-label">Submitted At</label>
                        <input type="text" class="form-control" id="ucreated_at">
                    </div>
                </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
<!-- End View Ticket Modal -->
@endsection
@auth
    <script>
        var user = {
        id: {{ auth()->user()->id }},
        name: '{{ auth()->user()->name }}'
    };
</script>
@endauth
@section('scripts')
<script>
    $(document).ready(function() {

      	var table = $('.data-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('user.userdash') }}",
            columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                {data: 'created_by', name: 'created_by'},
                {data: 'ticket_desc', name: 'ticket_desc'},
                {data: 'importance', name: 'importance'},
                {data: 'status', name: 'status'},
                {data: 'created_at', name: 'created_at'},
                {data: 'action', name: 'action', orderable: false, searchable: false},
            ]
      	});
  
      	$('#btnCreateTick').click(function (e) { 
            e.preventDefault();
            
          	$('#CreateTicket').modal('show')
      	});

      	$('#btnAdd').click(function (e) {
          	e.preventDefault();

            var userId = user.id;

            var data = {
                'user_id' : userId,
                'created_by' : $('#created_by').val(),
                'ticket_desc' : $('#ticket_desc').val(),
                'importance' : $('#importance').val(),
                'status' : $('#status').val(),
                'created_at' : $('#created_at').val(),
            }
            
  			
	        $.ajax({
	            type: "POST",
	            url: "user/userdash",
	            data: data,
	            dataType: "json",
	            success: function (response) {
	                $('#CreateTicket').modal('hide')
	            }
	        });
        });

        $('#viewtable').on ('click', '.view', (function (e) {
            e.preventDefault();
            var view_id = $(this).attr('id');
            var userId = user.id;
            $('#ViewTicket').modal('show')

                
            var data = $(this).data('info').split(',');
            $('#view_id').val(data[0]);
            $('#ucreated_by').val(data[1]); 
            $('#uticket_desc').val(data[2]);
            $('#uimportance').val(data[3]);
            $('#ustatus').val(data[4]);
            $('#ucreated_at').val(data[5]);
        }));



    });
  </script>
@endsection