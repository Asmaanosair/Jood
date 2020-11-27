<?php

namespace App\Http\Controllers\Admin;

use App\Branch;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BranchController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
        public function __construct()
    {
        $this->middleware('auth');

    }

    public function index()
    {
        $branches=Branch::with('District')->get();
        return response()->json($branches);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'address' => 'required|string',
            'latitude' => 'required|max:255',
            'longitude' => 'required|max:255',
        ]);

        $branches = new Branch();
        $branches->branch= $request->name;
        $branches->address= $request->address;
        $branches->lat= $request->latitude;
        $branches->long= $request->longitude;
        $branches->availability= $request->availability;
        $branches->save();
        return response()->json($branches);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $branch=Branch::find($id);
        return response()->json($branch);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'address' => 'required|string',
            'latitude' => 'required|max:255',
            'longitude' => 'required|max:255',
        ]);
        $branch = Branch::find($id);
        $branch->branch= $request->name;
        $branch->address= $request->address;
        $branch->lat= $request->latitude;
        $branch->long= $request->longitude;
        $branch->availability= $request->availability;
        $branch->save();
       // return response()->json($branch);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = Branch::find($id);
        $category->delete();
        return response()->json(' successfully deleted');
    }
    /**
     * ChangeAvailability the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function ChangeAvailability(Request $request, $id)
    {
        $branch = Branch::find($id);
        if($branch->availability==0) {
            $branch->availability = 1;
        }
        else{
            $branch->availability = 0;
        }
        $branch->save();

        // return response()->json($branch);
    }
}
