
@extends('layouts.app')


@section('content')

@include('layouts.tablenavbaruser')
<!-- Start Datatable -->
<div class="container mt-5">
    <div class="row mb-4">
        <h3 class="text">Open Tickets</h3>
        <button class="btn btn-dark mb-3" style="margin-left: 840px;" id="btnCreate">Create Tickets</button>
    </div>
    <table id="viewtable" class="table table-bordered data-table">
        <thead>
            <tr>
                <th>Ticket ID</th>
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
                <h5 class="modal-title">Create Tickets</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form>
                    @csrf
                    <div class="form-group">
                        <label for="created_by" class="col-form-label">Created By</label>
                        <input type="text" class="form-control" id="created_by" value="{{ auth()->user()->name }}" readonly>
                    </div>
                    <div class="form-group">
                        <label for="ticket_desc" class="col-form-label">Ticket Description</label>
                        <textarea class="form-control" id="ticket_desc" required></textarea>
                    </div>
                    <div class="form-group">
                        <label for="importance" class="col-form-label">Importance</label>
                        <select class="form-control" id="importance" name="importance" required>
                            <option required>Select One</option>
                            <option>Urgent</option>
                            <option>High</option>
                            <option>Low</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="status" class="col-form-label">Status</label>
                        <input type="text" class="form-control" id="status" value="Open" disabled>
                    </div>
                    <div class="form-group">
                        <label for="created_at" class="col-form-label">Submitted At</label>
                        <input type="datetime-local" value="{{ now()->setTimezone('T')->format('Y-m-dTh:m') }}" class="form-control" id="created_at" required>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" id="btnAdd" class="btn btn-primary">Submit</button>
            </div>
        </div>
    </div>
 </div>
<!-- End Add Ticket Modal -->

{{-- Archived Validation --}}
<div class="modal fade" id="confirmationModal" tabindex="-1" role="dialog" aria-labelledby="confirmationModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="confirmationModalLabel">Confirm Delete</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Are you sure you want to delete this data?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary" id="confirmUpdateButton">Confirm</button>
            </div>
        </div>
    </div>
</div>
{{-- End Archived Validation --}}


{{-- Success Creating Ticket --}}
<div class="modal fade" id="successMessage">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title text-success">Success Message</h4>
        </div>
        <div class="modal-body">
            <h5>Your ticket is created! Please wait for the Admin to accept your ticket. Thank you!</h5>
        </div>
        <div class="modal-footer">
            <button type="submit" class="btn btn-secondary" data-dismiss="modal">Close</button> 
        </div>
      </div>
    </div>
</div>
{{-- End Success Creating Ticket --}}

<!-- Error Message modal -->
<div class="modal fade" id="errorMessage">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title text-danger">Error Message</h4>
        </div>
        <div class="modal-body">
            <h5>Please fill out all field!</h5>
        </div>
        <div class="modal-footer">
            <button type="submit" class="btn btn-secondary" data-dismiss="modal">Close</button> 
        </div>
      </div>
    </div>
</div>
<!-- End Error Message modal -->

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
                @csrf
                <input type="text" id="view_id" hidden>
                    <div class="form-group">
                        <label for="ucreated_by" class="col-form-label">Created By</label>
                        <input type="text" class="form-control" id="ucreated_by" value="Client" disabled>
                    </div>
                    <div class="form-group">
                        <label for="uticket_desc" class="col-form-label">Ticket Description</label>
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
                        <label for="ustatus" class="col-form-label">Status</label>
                        <input type="text" class="form-control" id="ustatus" value="Open" disabled>
                    </div>
                    <div class="form-group">
                        <label for="ucreated_at" class="col-form-label">Submitted At</label>
                        <input type="text" class="form-control" id="ucreated_at" disabled>
                    </div>
                </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="button" id="btnUpdate" class="btn btn-primary">Delete</button>
        </div>
      </div>
    </div>
  </div>
<!-- End View Ticket Modal -->
@endsection


@section('scripts')
<script>
    $(document).ready(function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        var table = $('.data-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('user.userdash') }}",
            columns: [
                {data: 'id', name: 'DT_RowIndex'},
                {data: 'created_by', name: 'created_by'},
                {data: 'ticket_desc', name: 'ticket_desc'},
                {data: 'importance', name: 'importance'},
                {data: 'status', name: 'status'},
                {data: 'posted_on', name: 'posted_on'},
                {data: 'action', name: 'action', orderable: false, searchable: false},
            ]
        });
  
        $('#btnCreate').click(function (e) { 
            e.preventDefault();
            $('#CreateTicket').modal('show');
        });

        $('#btnAdd').click(function (e) {
            e.preventDefault();

            var user = {
                id: {{ auth()->user()->id }}
            };
            var userId = user.id;

            var data = {
                'user_id' : userId,
                'created_by' : $('#created_by').val(),
                'ticket_desc' : $('#ticket_desc').val(),
                'importance' : $('#importance').val(),
                'status' : $('#status').val(),
                'posted_on' : $('#created_at').val(),
            }

            $.ajax({
                type: "POST",
                url: "userdash/store",
                data: data,
                dataType: "json",
                success: function (response) {
                    $('#CreateTicket').modal('hide');
                    $('#successMessage').modal('show');
                    $('#viewtable').DataTable().ajax.reload();
                },
                error: function(response) {
                    $('#errorMessage').modal('show');
                }
            });
            
        });

        $('#CreateTicket').on('hidden.bs.modal', function () {
            $(this).find('form')[0].reset();
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
                    $('#ucreated_by').val(response.tickets.created_by);
                    $('#uticket_desc').val(response.tickets.ticket_desc);
                    $('#uimportance').val(response.tickets.importance);
                    $('#ustatus').val(response.tickets.status);
                    $('#ucreated_at').val(response.tickets.posted_on);
                }
            });
        }));


        $('#btnUpdate').click(function (e) {
            e.preventDefault();
            
            var update_id = $('#view_id').val();
            var data = {
                'created_by' : $('#ucreated_by').val(),
                'ticket_desc' : $('#uticket_desc').val(),
                'importance' : $('#uimportance').val(),
                'status' : 'Archived',
                'posted_on' : $('#ucreated_at').val()
            }
            $('#ViewTicket').modal('hide');
            $('#confirmationModal').modal('show');

            // handle the update action when the user clicks the "Update" button
            $('#confirmUpdateButton').click(function () {
                $.ajax({
                    type: "POST",
                    url: "update/"+update_id,
                    data: data,
                    dataType: "json",
                    success: function (response) {
                        $('#viewtable').DataTable().ajax.reload();
                    }
                });
                $('#confirmationModal').modal('hide');
            });
        });
    });
  </script>
@endsection