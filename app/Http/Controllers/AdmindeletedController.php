<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tickets;
use Yajra\Datatables\Datatables;

class AdmindeletedController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
   
    public function index(Request $request) {
        if ($request->ajax()) {
            $data = Tickets::latest()
                        ->where([['status', '=', 'Archived']])
                        ->get();
            return DataTables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($data) {
                           $btnView = '<div class="text-center"><button type="button" name="view" id="'.$data->id.'"class="view btn btn-secondary btn-sm mx-auto">View</button></div>';
                           return $btnView;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }
        return view('admin.Admindeleted');
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
