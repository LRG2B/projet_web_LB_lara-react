<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Save_blog;
use Illuminate\Http\Request;

class Save_blogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $save_blog = Save_blog::all();

        return response()->json($save_blog);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return response()->json();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Save_blog  $save_blog
     * @return \Illuminate\Http\Response
     */
    public function show(Save_blog $save_blog)
    {
        return response()->json();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Save_blog  $save_blog
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Save_blog $save_blog)
    {
        return response()->json();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Save_blog  $save_blog
     * @return \Illuminate\Http\Response
     */
    public function destroy(Save_blog $save_blog)
    {
        return response()->json();
    }
}
