<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $articles = Article::paginate(10);
        return response()->json([
            'data' => $articles
        ]);
    }



    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $articles = Article::create([
            'Title' => $request->input('title'),
            'Content' => $request->input('content'),
            'Articleimage' => $request->input('article_image'),
            'Articlecreator' => $request->input('article_creator'),
        ]);

        $upload_picture = $request->file('picture')->getClientOriginalName();
        $request->file('picture')->move('storage', $upload_picture);

        return response()->json([
            'data' => $articles
        ]);

    }

    /**
     * Display the specified resource.
     */
    public function show(Article $article)
    {
        return response()->json([
            'data' => $article
        ]);
    }



    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Article $article)
    {
        $article->Title = $request->title;
        $article->Content = $request->content;
        $article->Articleimage = $request->article_image;
        $article->Articlecreator = $request->article_creator;
        $article->save();

        return response()->json([
            'data' => $article
        ]);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Article $article)
    {
        $article->delete();
        return response()->json([
            'message' => 'article data deleted'
        ], 204);
    }
}