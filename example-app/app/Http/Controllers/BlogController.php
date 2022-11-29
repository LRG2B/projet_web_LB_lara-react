<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;

use App\Http\Requests\BlogStoreRequest; //pour aller chercher la verif de base commun au fonction store et update

use App\Http\Resources\BlogResource; //definie les donnée retourner par les methodes get : show et index


class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $blog = Blog::all();

        // On retourne les informations des utilisateurs en JSON
        return BlogResource::collection($blog);;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BlogStoreRequest $request)
    {
        $request->validate([
            'title' => 'required',
            'body' => 'required',
        ]);

        $blog = Blog::create($request->all());
        return [
            "status" => 1,
            "data" => $blog
        ];

        return response()->json($blog, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function show(Blog $blog)
    {
        // On retourne les informations de l'article en JSON
        return new BlogResource($blog);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function update(BlogStoreRequest $request, Blog $blog)
    {
        $request->validate([$request,
            'title' => 'required',
            'body' => 'required',
        ]);

        $blog->update([
            'title' => $request->title,
            'body' => $request->body
        ]);

        return response()->json();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function destroy(Blog $blog)
    {
        $blog->delete();
        return response()->json([
            "message" => "Article supprimer"
        ]);
    }
}