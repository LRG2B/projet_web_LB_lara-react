<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Save_blog;
use GuzzleHttp\Psr7\Message;
use Illuminate\Http\Request;

class Save_blogController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        session_start();

        if (isset($_COOKIE['PHPSESSID']) && isset($_SESSION['account_id'])) {
            if ($_COOKIE['PHPSESSID'] == session_id() || $_SESSION['admin']){

                    $this->validate($request, [
                        'article_id' => 'required'
                    ]);
            
                    $save_blog = Save_blog::created([
                        'account_id' => $request->account_id,
                        'article_id' => $_SESSION['account_id']
                    ]);
            
                    return response()->json($save_blog, 201);              
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
     * @param  \App\Models\Save_blog  $save_blog
     * @return \Illuminate\Http\Response
     */
    public function show(Save_blog $save_blog)
    {
        
        session_start();

        if (isset($_COOKIE['PHPSESSID']) && isset($_SESSION['account_id'])) {
            if ($_COOKIE['PHPSESSID'] == session_id() || $_SESSION['admin']){
                
                return response()->json($save_blog);                            
            }
            else
                return response()->json([
                    "message" => "Vous n'avez pas l'autorisation pour accéder a ce contenu"
                ]);
        } else {
            return response()->json([
                "message" => "Il faut aller ce connecter"
            ]);
        }   
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Save_blog  $save_blog
     * @return \Illuminate\Http\Response
     */
    public function destroy(Save_blog $save_blog)
    {
                
        session_start();

        if (isset($_COOKIE['PHPSESSID']) && isset($_SESSION['account_id'])) {
            if ($_COOKIE['PHPSESSID'] == session_id() || $_SESSION['admin']){
                               
                $save_blog->delete();
        
                return response()->json([
                    'message' => 'article supprimer'
                ]);                                            
            }
            else
                return response()->json([
                    "message" => "Vous n'avez pas l'autorisation pour accéder a ce contenu"
                ]);
        } else {
            return response()->json([
                "message" => "Il faut aller ce connecter"
            ]);
        }   
    }
}
