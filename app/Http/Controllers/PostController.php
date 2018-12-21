<?php

namespace App\Http\Controllers;
use App\Category;
use App\Post;
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
         $tages=[ ['id'=>"id","name"=>"name"] ];
         $tags=  json_decode(json_encode($tages));

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
        dump($post);
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

        $cats = array();
        foreach ($categories as $category){
            $cats[$category->id]=$category->name;
        }

      return view('posts.edit')->withPost($post)->withCategories($cats);

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

         if($request->input('slug')== $post->slug){
             $validated =$request->validated([
                 "slug" =>'required|alpha_dash|min:5|max:100 ',
                 "body" =>'required|min:5',
                 "title" =>'required|min:10|max:25'
             ]);
         }else{
            $validated = $request->validated();
         }
        $post->update($validated);
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
        $post->delete();
         Session::flash('success',"the post is Deleted");
        return redirect()->route('posts.index');
    }
}
