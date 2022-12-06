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
        $users = Category::all();

        // On retourne les informations des utilisateurs en JSON
        return response()->json($users);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

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

        return response()->json();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        $category->delete();

        return response()->json();
    }
}
