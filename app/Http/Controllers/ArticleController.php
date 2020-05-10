<?php

namespace App\Http\Controllers;

use App\Articles;
use App\Http\Requests\ArticleRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class ArticleController extends Controller
{
    public function showCreate(){
        return view('articleCreate');
    }

    public function storeArticle(ArticleRequest $request)
    {
        $validator_data = $request->validated();

        Articles::create([
           'title' => $validator_data['title'],
           'body' => $validator_data['body'],
           'slug' =>  Str::of($validator_data['title'])->slug('-')
        ]);

    }

    public function viewEdit(Articles $articles){

        return view('articles.edit',[
            'article' => $articles
        ]);
    }

    public function delete(Articles $articles){
        $articles->delete();
        return back();
    }

    public function update(ArticleRequest $request,$id){
        $validated_data = $request->validated();

        $article = Articles::findOrFail($id);

        if (is_null($article)){
            abort(404);
        }

        $article->update([
            'title' => $validated_data['title'],
            'body' => $validated_data['body'],
        ]);
    }

    public function index(){
        return view('articles.index',[
            'articles' => Articles::all()
        ]);
    }


}
