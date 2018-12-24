<?php

namespace App\Http\Controllers;
use App\Category;
use App\Post;
use App\Tag;
//use Illuminate\Http\Request;
use App\Http\Requests\PostStoreRequest;
use Session;

class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except('index');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::orderBy('id','desc')->paginate(10);
        return view('posts.index',compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {    $categories = Category::all();
        $tags = Tag::all();
       return view('posts.create', compact('categories','tags'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  App\Http\Requests\PostStoreRequest
     * @return \Illuminate\Http\Response
     */
    public function store(PostStoreRequest $request)
    {

        $validated = $request->validated();
        $post=Post::create($validated);
        $post->tags()->sync($request->tags,false);

       Session::flash('success',"the blog was saved");
        return redirect()->route('posts.show',$post->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {

        return view('posts.show',compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        $categories =Category::all();
        $alltag =Tag::all();

        $cats = array();
        foreach ($categories as $category){
            $cats[$category->id]=$category->name;
        }
        $tgs = array();
        foreach ($alltag as $tag){
            $tgs[$tag->id]=$tag->name;
        }

      return view('posts.edit')->withPost($post)->withCategories($cats)->withTags($tgs);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(PostStoreRequest $request, Post $post)
    {

        $validated = $request->validated();
        $post->update($validated);

        if(isset($request->tags)){
            $post->tags()->sync($request->tags,true);
        }else{
            $post->tags()->sync([],true);
        }


        Session::flash('success','the Post was updated successfully');
        return redirect()->route('posts.show',compact('post'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $post->tags()->detach();
        $post->delete();
         Session::flash('success',"the post is Deleted");
        return redirect()->route('posts.index');
    }
}
