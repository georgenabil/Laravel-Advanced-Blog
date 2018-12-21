<?php

namespace App\Http\Controllers;
use App\Post;
use Illuminate\Http\Request;


class PagesController extends Controller
{
    public function contact()
    {
        return view('pages.contact');
    }

    public  function about (){

        return view ('pages.about');
    }

    public  function blog(){
        $posts=Post::all();
        return view('pages.welcome')->with('posts',$posts);
    }
}
