<?php

namespace App\Http\Controllers;

use App\Articles;
use App\Http\Requests\ArticleRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class ArticleController extends Controller
{


    //   This function just sends the user to the articleCreate view

    public function showCreate(){
        return view('articleCreate');
    }


    /*
     *    This function is for saving the articleCreate form to the database
     *    At first it validates the form with the ArticleRequest Request and if it was invalid, it sends back the errors,
     *    else, it will save the form in the database
     */
    public function storeArticle(ArticleRequest $request)
    {
        $validator_data = $request->validated();

        Articles::create([
           'title' => $validator_data['title'],
           'body' => $validator_data['body'],
           'slug' =>  Str::of($validator_data['title'])->slug('-')
        ]);

    }



    //   This function just sends the user to the articles.edit view

    public function viewEdit(Articles $articles){

        return view('articles.edit',[
            'article' => $articles
        ]);
    }



    /*
     *    This is a function for deleting the articles
     *    At first after the auth method in the web.php file checked the authentication, it will check if you are the owner of the article or not
     *    If you were, it will let you delete the article
     *    Otherwise, it will send you back with an error text
     */
    public function delete(Articles $articles){

        if (auth()->user()->id == $articles->user_id){
            $articles->delete();
            return back();
        }else {
            return
                view('home', [
                    'notOwner' => 'This article is not yours'
                ]);
        }
    }


    /*
     *    This is a function for updating the articles
     *    At first after the auth method in the web.php file checked the authentication, it validates the form with the ArticleRequest Request and if it was invalid, it sends back the errors,
     *    Else, it will update the article and sends it to the database
     */
    public function update(ArticleRequest $request,Articles $articles){
        $validated_data = $request->validated();

        if (auth()->user()->id == $articles->user_id){
            $article = Articles::findOrFail($articles->id);

            if (is_null($article)){
                return abort(404);
            }
                return $article->update([
                'title' => $validated_data['title'],
                'body' => $validated_data['body'],
            ]);
        }else {
            return
                view('home', [
                    'notOwner' => 'This article is not yours'
                ]);
        }

    }



    //   This method is the main method that shows the articles that are confirmed by the admin
    public function index(){
        return view('articles.index',[
            'articles' => Articles::all()->where('confirmation', '=',1)
        ]);
    }


}
