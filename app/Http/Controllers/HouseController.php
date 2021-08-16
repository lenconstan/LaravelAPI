<?php

namespace App\Http\Controllers;
use App\Models\House;


use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Profiler\Profile;

class HouseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return House::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            "title" => 'required',
            "address" => 'required',
            "city" => 'required',
            "rooms" => 'required',
            "sleepingPlaces" => 'required',
            "description" => 'required',

        ]);

        return House::create($request->all());    

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($user_id)
    {
        return House::where('user_id', $user_id)->get();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $user_id)
    {
        $profile  = House::where('user_id', $user_id)->first();
        $profile->update($request->all());
        return $profile;

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        House::destroy($id);
        return json_encode("Profile ". $id. " has been deleted successfully!");
    }
}
