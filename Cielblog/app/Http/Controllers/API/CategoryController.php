<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $category = Category::all();

        // On retourne les informations des utilisateurs en JSON
        return response()->json($category);
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

                    //on vérifies les entrées
                    $this->validate($request, [
                        'name' => 'required|max:100',
                        'slug' => 'required|max:100'
                    ]);
                
                    // On crée une nouvelle categorie
                    $category = Category::create([
                        'name' => $request->name,
                        'slug' => $request->slug
                    ]);

                    return response()->json($category, 201); //201 veux dire donnée inserer 
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
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        return response()->json($category);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        session_start();

        if (isset($_COOKIE['PHPSESSID'])) {
            if ($_COOKIE['PHPSESSID'] == session_id()) {

                if ($_SESSION['admin']) {
                     //on vérifies les entrées
                    $this->validate($request, [
                        'name' => 'required|max:100',
                        'slug' => 'required|max:100'
                    ]);
                
                    // On crée une nouvelle categorie
                    $category->update([
                        'name' => $request->name,
                        'slug' => $request->slug
                    ]);

                    return response()->json([
                        "message" => "Article modifier"
                    ],201);
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
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        session_start();

        if (isset($_COOKIE['PHPSESSID'])) {
            if ($_COOKIE['PHPSESSID'] == session_id()) {
                
                if ($_SESSION['admin']) {
                    
                    $category->delete();
            
                    return response()->json([
                        "message" => "Article supprimer"
                    ]);
                    
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
}
