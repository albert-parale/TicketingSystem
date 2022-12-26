<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tickets;
use Yajra\Datatables\Datatables;

class AdminresolvedController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
   
    public function index(Request $request) {
        if ($request->ajax()) {
            $data = Tickets::latest()
                        ->where([['status', '=', 'Resolved']])
                        ->get();
            return DataTables::of($data)
                    ->setRowId('id')
                    ->addIndexColumn()
                    ->addColumn('action', function($data) {
                           $btnView = '<button type="button" name="view" id="'.$data->id.'" class="view btn btn-primary btn-sm">View</button>';
                           return $btnView;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }
        return view('admin.Adminresolved');
    }

    public function edit($id)
    {
        $tickets = Tickets::find($id);
        if ($tickets){
            return response()->json([
                'status' => 200,
                'tickets' => $tickets,
            ]);
        }
        else
        {
            return response()->json([
                'status' => 404,
                'tickets' => 'tickets not Found',
            ]);
        }
    }

     public function update($id) 
    {
        $tickets = Tickets::find($id);
        $tickets->created_by = request('created_by');
        $tickets->ticket_desc = request('ticket_desc');
        $tickets->importance = request('importance');
        $tickets->status = request('status');
        $tickets->remarks = request('remarks');
        $tickets->save();
        return response()->json();

    }

}
