<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Save_blog;
use GuzzleHttp\Psr7\Message;
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
        $this->validate($request, [
            'account_id' => 'required',
            'article_id' => 'required'
        ]);

        $save_blog = Save_blog::created([
            'account_id' => $request->account_id,
            'article_id' => $request->article_id
        ]);

        return response()->json($save_blog, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Save_blog  $save_blog
     * @return \Illuminate\Http\Response
     */
    public function show(Save_blog $save_blog)
    {
        return response()->json($save_blog);
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
        $this->validate($request, [
            'account_id' => 'required',
            'article_id' => 'required'
        ]);

        $save_blog->update([
            'account_id' => $request->account_id,
            'article_id' => $request->article_id
        ]);

        return response()->json([
            'message' => 'article modifier'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Save_blog  $save_blog
     * @return \Illuminate\Http\Response
     */
    public function destroy(Save_blog $save_blog)
    {
        $save_blog->delete();

        return response()->json([
            'message' => 'article supprimer'
        ]);
    }
}
