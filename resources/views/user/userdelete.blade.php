@extends('layouts.app')


@section('content')

@include('layouts.tablenavbaruser')
<!-- Start Datatable -->
<div class="container mt-1">
    <div class="row mt-5">
        <h3 class="text">Deleted Tickets</h3>
    </div>
    <table id="viewtable" class="table table-bordered data-table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Created by</th>
                <th>Ticket Description</th>
                <th>Importance</th>
                <th>Status</th>
                <th>Remarks</th>
                <th>Submitted at</th>
                <th width="100px">Action</th>
            </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
</div>
<!-- End Datatable -->

<!-- Start View Ticket Modal -->
<div class="modal fade" id="ViewTicket" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
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
                <input type="text" id="view_id" hidden>
                <form>
                    <form>
                    <div class="form-group">
                        <label for="created_by" class="col-form-label">Created By</label>
                        <input type="text" class="form-control" id="ucreated_by" value="Client" disabled>
                    </div>
                    <div class="form-group">
                        <label for="firstname" class="col-form-label">Ticket Description</label>
                        <textarea class="form-control" id="uticket_desc" disabled></textarea>
                    </div>
                    <div class="form-group">
                        <label for="firstname" class="col-form-label">Importance</label>
                        <select class="form-control" id="uimportance" name="importance" disabled>
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
                        <label for="firstname" class="col-form-label">Remarks</label>
                        <textarea class="form-control" id="uremarks" disabled></textarea>
                    </div>
                    <div class="form-group">
                        <label for="lastname" class="col-form-label">Submitted At</label>
                        <input type="text" class="form-control" id="ucreated_at" disabled>
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

@section('scripts')
<script>
    $(document).ready(function() {

        var table = $('.data-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('user.userdelete') }}",
            columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                {data: 'created_by', name: 'created_by'},
                {data: 'ticket_desc', name: 'ticket_desc'},
                {data: 'importance', name: 'importance'},
                {data: 'status', name: 'status'},
                {data: 'remarks', name: 'remarks'},
                {data: 'created_at', name: 'created_at'},
                {data: 'action', name: 'action', orderable: false, searchable: false},
            ]
        });
  
        $('#btnCreateTick').click(function (e) { 
            e.preventDefault();
            
            $('#CreateTicket').modal('show')
        });

        $('#viewtable').on ('click', '.view', (function (e) {
        e.preventDefault();
        var view_id = $(this).attr('id');
        $('#view_id').val(view_id);
        $('#ViewTicket').modal('show')

            $.ajax({
                type: "GET",
                url: "edit/"+view_id,
                dataType: "json",
                success: function (response) {
                    $('#ucreated_by').val(response.tickets.created_by),
                    $('#uticket_desc').val(response.tickets.ticket_desc),
                    $('#uimportance').val(response.tickets.importance),
                    $('#ustatus').val(response.tickets.status),
                    $('#uremarks').val(response.tickets.remarks),
                    $('#ucreated_at').val(response.tickets.created_at)
                }
            });
        }));


        
    });
  </script>
@endsection