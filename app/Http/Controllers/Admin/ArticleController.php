<?php

namespace App\Http\Controllers\Admin;

use App\Articles;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use function foo\func;

class ArticleController extends Controller
{

    // this constructor method checks for the user login for every other methods before firing them
    public function __construct()
    {
        $this->middleware('auth');
    }


       /*   This is the main method of articles that shows every available article to the admin
        *   At first after the constructor method checked the authentication, this method checks if the user that is logged in is an admin or not
        *   Then if the user was an admin, it gets the articles from database that are confirmed and the ones that are not and send them to admin.articles view
        *   If the user wasn't an admin, it will send him/her to the home page with an error text
        */
    public function index(){

        if (auth()->user()->administration) {
            $mustConfirm = Articles::where('confirmation', 0)->get();
            $confirmed = Articles::where('confirmation', 1)->get();

            return
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


    /*
     *    This is a method for admin to delete any article that he wants
     *    At first, after the constructor method checked the authentication, this method checks if the user that is logged in is an admin or not
     *    Then if the user was an admin, this method finds and deletes the article that admin selected
     *    If the user wasn't an admin, it will send him/her to the home page with an error text
     */
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


    /*
     *    This method is for the admin to confirm the articles that are made by any other user
     *    At first, after the constructor method checked the authentication, this method checks if the user that is logged in is an admin or not
     *    Then if the user was an admin, this method find and confirms the article that admin selects
     *    If the user wasn't an admin, it will send him/her to the home page with an error text
     */
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
