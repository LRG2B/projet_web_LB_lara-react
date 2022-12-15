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
    public function index(Request $request)
    {
        $save_blog = Save_blog::where('user_id', $request->user()->id)->get();
        

        // On retourne les informations des utilisateurs en JSON
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
            'article_id' => 'required'
        ]);
            
        $save_blog = Save_blog::create([
            'article_id' => $request->article_id,
            'user_id' => $request->user()->id
        ]);
            
        return response()->json($save_blog, 201);              
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
