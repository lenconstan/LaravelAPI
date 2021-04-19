<?php

namespace App\Http\Controllers;
use App\Models\House;


use Illuminate\Http\Request;

class HouseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
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
        // ensure name is given
        $request->validate([
            'name' => 'required',
            'user_id' => 'required',
        ]);
        echo $request->name, $request->user_id;

        // ensure the request has a file
        if ($request->hasFile('file')) {
            echo 'file found';

            $request->validate([
                'image' => 'mimes:jpg,jpeg,bmp,png'
            ]);

            // store the file locally
            $request->file->store('houses', 'public');

            //Store the record using a file hashname
            return House::create([
                'name' => $request->name,
                'user_id' => (int)($request->user_id),
                'file_path' => $request->file->hashName(),
            ]);       
        }

        return json_encode("File does not match criterea");

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
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
