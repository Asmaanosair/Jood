<?php

namespace App\Http\Controllers\Admin;

use App\Slider;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SliderController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');

    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        $sliders=Slider::all();
        return response()->json([$sliders]);
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
            'name' => 'required|string|unique:regions|max:255',
            'image' => 'required|mimes:jpeg,jpg,png,gif',
        ]);
        $slider = new Slider();
        if($request->image!=null)
        {
            $filName=time().".".$request->image->getClientOriginalExtension();
            $path='adminassets/images/';
            $imagePath= $request->file('image')->move($path,$filName);

            $slider->image=$path.$filName;
        }
        $slider->title= $request->name;
        $slider->save();
        return response()->json($slider);
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
        $slider=Slider::find($id);
        return response()->json([$slider]);
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
            'image' => 'mimes:jpeg,jpg,png,gif',
        ]);
        $slider = Slider::find($id);
        if($request->image!=null)
        {
            $filName=time().".".$request->image->getClientOriginalExtension();
            $path='adminassets/images/';
            $imagePath= $request->file('image')->move($path,$filName);

            $slider->image=$path.$filName;
        }
        $slider->title = $request->name;
        $slider->save();
        return response()->json(compact('slider'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $slider = Slider::find($id);
        $slider->delete();
        return response()->json(' successfully deleted');
    }
}
