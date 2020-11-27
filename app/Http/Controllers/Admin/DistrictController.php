<?php

namespace App\Http\Controllers\Admin;

use App\Branch;
use App\City;
use App\District;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Validator;

class
DistrictController extends Controller
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
        $districts= DB::table('districts')
            ->join('cities', 'districts.city_id', '=', 'cities.id')
            ->join('branches', 'districts.branch_id', '=', 'branches.id')
            ->select('districts.*', 'cities.city','branches.branch')
            ->get();
        $cities=City::all();
        $branches=Branch::all();
        return response()->json(compact('cities','districts','branches'));

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
            'name' => 'required|string|max:255',
            'cityId' => 'required',
            'branchId' => 'required',
            'latitude' => 'required|max:255',
            'longitude' => 'required|max:255',
        ]);
        $district = new District();
        $district->name= $request->name;
        $district->city_id= $request->cityId;
        $district->branch_id= $request->branchId;
        $district->lat= $request->latitude;
        $district->long= $request->longitude;
        $district->availability= $request->availability;
        $district->save();
        return response()->json($district);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $district=District::find($id);
        return response()->json([$district]);
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
            'name' => 'required|string|max:255',
            'cityId' => 'required',
            'branchId' => 'required',
            'latitude' => 'required|max:255',
            'longitude' => 'required|max:255',
        ]);
        $district =District::find($id);
        $district->name= $request->name;
        $district->city_id= $request->cityId;
        $district->branch_id= $request->branchId;
        $district->lat= $request->latitude;
        $district->long= $request->longitude;
        $district->availability= $request->availability;
        $district->save();
        return response()->json($district);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $district = District::find($id);
        $district->delete();
        return response()->json('The district successfully deleted');
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
        $branch = District::find($id);
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
