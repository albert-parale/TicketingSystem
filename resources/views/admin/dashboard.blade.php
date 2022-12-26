@extends('layouts.app')

@section('content')
@include('layouts.tablenavbar')
 <div class="container mt-4">
    <h3 class="text-center">Open Tickets</h3>
    <table class="table table-bordered data-table" id="viewtable">
        <thead>
            <tr>
                <th>ID</th>
                <th>Created By</th>
                <th>Ticket Description</th>
                <th>Importance</th>
                <th>Status</th>
                <th>Created At</th>
                <th width="100px">Action</th>
            </tr>
        </thead>
        <tbody class="text-center">
        </tbody>
    </table>
</div>

<!-- Start View Ticket Modal -->
<div class="modal fade" id="ViewTicket" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="staticBackdropLabel">Open Tickets</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form>
                @csrf
                <input type="text" id="view_id" hidden>
                <div class="form-group">
                  <label for="firstname" class="col-form-label">Created By</label>
                  <input type="text" class="form-control" id="created_by" disabled>
                </div>
                <div class="form-group">
                  <label for="firstname" class="col-form-label">Ticket Description</label>
                  <textarea class="form-control" id="ticket_desc" disabled></textarea>
                </div>
                <div class="form-group">
                  <label for="firstname" class="col-form-label">Importance</label>
                  <input type="text" class="form-control" id="importance" disabled>
                </div>
                <div class="form-group">
                  <label for="firstname" class="col-form-label">Status</label>
                  <input type="text" class="form-control" id="status" disabled>
                </div>
                <div class="form-group">
                  <label for="lastname" class="col-form-label">Created At</label>
                  <input type="text" class="form-control" id="created_at" disabled>
                </div>
              </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="button" id="btnUpdate" class="btn btn-primary">Accept</button>
        </div>
      </div>
    </div>
  </div>
<!-- End View Ticket Modal -->
@endsection

@section('scripts')

<script type="text/javascript">
  $(document).ready(function() {
    
    var table = $('.data-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ route('admin.dashboard') }}",
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

    $('#viewtable').on ('click', '.view', (function (e) {
        e.preventDefault();
        var view_id = $(this).attr('id');
        $('#view_id').val(view_id);
        $('#ViewTicket').modal('show')

        $.ajax({
            type: "GET",
            url: "dashboard/"+view_id,
            dataType: "json",
            success: function (response) {
                $('#created_by').val(response.tickets.created_by);
                $('#ticket_desc').val(response.tickets.ticket_desc);
                $('#importance').val(response.tickets.importance);
                $('#status').val(response.tickets.status);
                $('#created_at').val(response.tickets.created_at);
            }
        });
    }));


    $('#btnUpdate').click(function (e) {
        e.preventDefault();
        
        var update_id = $('#view_id').val();
        
        var data = {
            
            'created_by' : $('#created_by').val(),
            'ticket_desc' : $('#ticket_desc').val(),
            'importance' : $('#importance').val(),
            'status' : 'Pending',
            'created_at' : $('#created_at').val()
        }

        $.ajax({
            type: "POST",
            url: "update/"+update_id,
            data: data,
            dataType: "json",
            success: function (response) {
                
            }
        });
        $('#ViewTicket').modal('hide');
    });
  });
</script>
@endsection
