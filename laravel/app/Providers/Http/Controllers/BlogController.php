<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Posts;
use Barryvdh\Debugbar\Facade as DebugBar;

class BlogController extends Controller
{


    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

    public function index()
    {
        //fetch 5 posts from database which are active and latest
        $posts = Posts::where('active',1)->orderBy('created_at','desc')->paginate(5);
        //page heading
        $title = 'Latest Posts';
        Debugbar::info($posts);
        //return home.blade.php template from resources/views folder
        return view('blog')->withPosts($posts)->withTitle($title);
    }
}
