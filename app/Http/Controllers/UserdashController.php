<?php

namespace App\Http\Controllers;

use App\Http\Controllers;
use App\Tickets;
use Illuminate\Foundation\Auth\User;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;


class UserdashController extends Controller
{


    public function index(Request $request) {

        if ($request->ajax()) {
            $id = auth()->user()->id;
            $data = Tickets::with('user')
                          ->where([['user_id', '=', $id], ['status', '=', 'open']])
                          ->get();

            return DataTables::of($data)
                    ->setRowId('id')
                    ->addIndexColumn()
                    ->addColumn('action', function($data) {
                           $btnView = '<button type="button" name="view" id="'.$data->id.'" class="view btn btn-primary btn-sm" 
                           data-info="'.$data->id.','.$data->created_by.','.$data->ticket_desc.','.$data->importance.','.$data->status.','.$data->created_at.'">View</button>';
                           return $btnView;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }
        
        return view('user.userdash');
    }

    public function store()
    {
        request()->validate([
            'created_by' => 'required',
            'ticket_desc' => 'required',
            'importance' => 'required',
            'status' => 'required',
            'created_at' => 'required',
            'user_id' => 'required|exists:users,id'
        ]);

        $tickets = new Tickets();
        $tickets->user_id = auth()->user()->id;
        $tickets->created_by = request('created_by');
        $tickets->ticket_desc = request('ticket_desc');
        $tickets->importance = request('importance');
        $tickets->status = request('status');
        $tickets->created_at = request('created_at');
        $tickets->save();
        return response()->json();
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

}