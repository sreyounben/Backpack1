<?php

namespace App\Http\Controllers\Api;

use App\Models\API\Article;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


class ArticleController extends Controller
{
    public function index()
    {
            if (request()->search)
            {
                $articles = Article::where('title','like', "%" .request()->search. "%")->get();
            }else{
                $articles = Article::all();
            }

            return response()->json(['Article'=>$articles]);
    }

    public function show(Article $article)
    {
        return $article;
    }
    

    public function store(Request $request)
    {
        $article = Article::create($request->all());
        return response()->json($article->all());
    }


    public function update(Request $request, $id)
    {
        $article = Article::findOrFail($id);
        $article->update($request->all());
        return $article;
        return response()->json(['success','data update success']);
    }


    public function destroy(Request $request,$id)
    {
        Article::find($id)->delete();
        return response()->json(['success','Delete succee!!']);
    }
}
