<?php

namespace App\Http\Controllers\Admin;

use App\Articles;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    public function index(){

        $mustConfirm = Articles::where('confirmation', 0)->get();
        $confirmed = Articles::where('confirmation', 1)->get();

        view('admin.articles',[
            'mustConfirm' => $mustConfirm,
            'confirmed' => $confirmed
        ]);
    }


    public function delete(Articles $articles){
        $articles->delete();
        return back();
    }

    public function confirm(Articles $articles){

        if (is_null($articles)){
            abort(404);
        }

        $articles->update([
            'confirmation' => true
        ]);
    }
}
