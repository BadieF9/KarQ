<?php

namespace App\Http\Controllers\Admin;

use App\Articles;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use function foo\func;

class ArticleController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index(){
        if (auth()->user()->administration) {
            $mustConfirm = Articles::where('confirmation', 0)->get();
            $confirmed = Articles::where('confirmation', 1)->get();

            view('admin.articles', [
                'mustConfirm' => $mustConfirm,
                'confirmed' => $confirmed
            ]);
        } else {
            return
                view('home',[
                    'notAdmin' => 'This is jut for admins'
                ]);

        }
    }


    public function delete(Articles $articles){
        if (auth()->user()->administration) {
            $articles->delete();
            return back();
        } else {
            return
                view('home',[
                    'notAdmin' => 'This is jut for admins'
                ]);
        }
    }

    public function confirm(Articles $articles)
    {
        if (auth()->user()->administration) {
            if (is_null($articles)) {
                abort(404);
            }

            $articles->update([
                'confirmation' => true
            ]);
            return back();
        } else {
            return
                view('home',[
                    'notAdmin' => 'This is jut for admins'
                ]);
        }
    }
}
