<?php

namespace App\Http\Controllers;

use App\Models\apiTest;
use Illuminate\Http\Request;

class apiTestController extends Controller
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
       

        

        $apiTest = new apiTest();
        $apiTest->name = $request->name;
        $filename = time() . '.' . $request->file->extension();
        $apiTest->file = $request->file->storeAs('public/apitest', $filename);
        $apiTest->save();

        

        return response()->json(
            [
                'message' => 'successfully',
                'data' => $apiTest
            ]
            );

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\apiTest  $apiTest
     * @return \Illuminate\Http\Response
     */
    public function show(apiTest $apiTest)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\apiTest  $apiTest
     * @return \Illuminate\Http\Response
     */
    public function edit(apiTest $apiTest)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\apiTest  $apiTest
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, apiTest $apiTest)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\apiTest  $apiTest
     * @return \Illuminate\Http\Response
     */
    public function destroy(apiTest $apiTest)
    {
        //
    }
}
