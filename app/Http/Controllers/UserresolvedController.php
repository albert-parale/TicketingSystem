<?php

namespace App\Http\Controllers;

use App\Tickets;
use Illuminate\Foundation\Auth\User;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class UserresolvedController extends Controller
{
    public function index(Request $request) {

        if ($request->ajax()) {
            $id = auth()->user()->id;
            $data = Tickets::with('user')
                            ->where([['user_id', '=', $id], ['status', '=', 'Resolved']])
                            ->latest()->get();
            return DataTables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($data) {
                           $btnView = '<div class="text-center"><button type="button" name="view" id="'.$data->id.'"class="view btn btn-secondary btn-sm mx-auto">View</button></div>';
                           return $btnView;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }
        
        return view('user.userresolved');
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