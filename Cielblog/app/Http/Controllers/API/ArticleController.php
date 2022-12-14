<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Article;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function get_articles()
    {
        $article = Article::all();

        return response()->json($article);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function add(Request $request)
    {
        $this->validate($request, [
            'title' => 'required|max:100',
            'body' => 'required',
            'category_id' => 'required'
        ]);
            
        $article = Article::create([
            'title' => $request->title,
            'body' => $request->body,
            'category_id' => $request->category_id,
            'user_id' => $request->user()->id
        ]);
            
        return response()->json($article, 201);
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function show(Article $article)
    {
        return response()->json($article);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function patch(Request $request, Article $article)
    {
        $this->validate($request, [
            'title' => 'required|max:100',
            'body' => 'required',
            'category_id' => 'required'
        ]);
            
        $article->update([
            'title' => $request->title,
            'body' => $request->body,
            'category_id' => $request->category_id
        ]);
            
        return response()->json([
            "message" => "Article modifier"
        ]);
    
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function delete(Article $article)
    {
        $article->delete();
        
        return response()->json([
            "message" => "Article supprimer"
        ]);
    }
}
