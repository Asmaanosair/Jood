<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Order;
use Illuminate\Http\Request;

class ReportsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');

    }
    public function index(){
        return view('main');
    }
    public function search(Request $request)
    {
      //  dd(date('d',$request->theDate));
        if($request->arrange=='d') {
            $report = Order::whereDay('created_at', (date('d', strtotime($request->theDate))))->get();
        }elseif ($request->arrange=='m'){
            $report = Order::whereMonth('created_at',(date('m', strtotime($request->theDate))))->get();
        }else{
            $report = Order::whereYear('created_at', (date('Y', strtotime($request->theDate))))->get();
        }
        $report=$report->where('status',3);
        return response()->json($report);
    }
}
