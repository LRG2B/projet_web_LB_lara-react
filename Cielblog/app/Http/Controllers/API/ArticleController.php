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
    public function index()
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
    public function store(Request $request)
    {
        session_start();

        if (isset($_COOKIE['PHPSESSID'])) {
            if ($_COOKIE['PHPSESSID'] == session_id()) {
                
                if ($_SESSION['admin']) {

                    $this->validate($request, [
                        'title' => 'required|max:100',
                        'body' => 'required',
                        'category_id' => 'required'
                    ]);
            
                    $article = Article::created([
                        'title' => $request->title,
                        'body' => $request->body,
                        'category_id' => $request->category_id,
                        'account_id' => $_SESSION['account_id']
                    ]);
            
                    return response()->json($article, 201);
                   
                } else
                    return response()->json([
                        "message" => "Vous n'avez pas l'autorisation pour accéder a ce contenu"
                    ]);
            }
        } else {
            return response()->json([
                "message" => "Il faut aller ce connecter"
            ]);
        }
        
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
    public function update(Request $request, Article $article)
    {
        session_start();

        if (isset($_COOKIE['PHPSESSID'])) {
            if ($_COOKIE['PHPSESSID'] == session_id()) {
                
                if ($_SESSION['admin']) {

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
    
                } else
                    return response()->json([
                        "message" => "Vous n'avez pas l'autorisation pour accéder a ce contenu"
                    ],201);
            }
        } else {
            return response()->json([
                "message" => "Il faut aller ce connecter"
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function destroy(Article $article)
    {
        session_start();

        if (isset($_COOKIE['PHPSESSID'])) {
            if ($_COOKIE['PHPSESSID'] == session_id()) {
                
                $article->delete();
        
                return response()->json([
                    "message" => "Article supprimer"
                ]);

            }
        } else {
            return response()->json([
                "message" => "Il faut aller ce connecter"
            ]);
        }

    }
}
