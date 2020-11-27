<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');

    }
    public function edit($id)
    {
        $setting=Setting::find($id);
        return response()->json([$setting]);
    }
    public function update(Request $request, $id)
    {

        $this->validate($request, [
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:255',
            'email' => 'required|string|max:255',
            'keywords' => 'required|string',
            'description' => 'required|string',
            'facebook' => 'required|string',
            'twitter' => 'required|string',
            'instagram' => 'required|string',
            'image' => 'mimes:jpeg,jpg,png,gif',
        ]);
        $setting = Setting::find($id);
        if($request->image!=null)
        {
            $filName=time().".".$request->image->getClientOriginalExtension();
            $path='adminassets/images/';
            $imagePath= $request->file('image')->move($path,$filName);

            $setting->logo=$path.$filName;
        }
        $setting->siteName = $request->name;
        $setting->phone = $request->phone;
        $setting->email = $request->email;
        $setting->keywords = $request->keywords;
        $setting->description = $request->description;
        $setting->facebook = $request->facebook;
        $setting->twitter = $request->twitter;
        $setting->instagram = $request->instagram;
        $setting->save();
        return response()->json(compact('setting'));
    }
}
