@extends('main')

@section('title', '| View Post')

@section('content')

   <div class="row">
       <div class="col-md-6">
         <h1>{{$post->title}}</h1>
         <p class="lead">{{$post->body}}</p>
       </div>


       <div class="col-md-4">
           <div class="well">

               <dl >
                   <dt>url: </dt>
                   <dd><a href="{{ url('blog/'.$post->slug) }}">{{Request::getHost().':8000/blog/'.$post->slug}}</a></dd>
               </dl>
               <dl >
                   <dt>category: </dt>
                   <dd>{{$post->category->name}}</dd>
               </dl>
               <dl >
                   <dt>Created at: </dt>
                   <dd>{{$post->created_at}}</dd>
               </dl>
               <dl >
                   <dt>updated at: </dt>
                   <dd>{{ $post->updated_at }}</dd>
               </dl>


               <hr>

               <div class="row">

                   <div class="col-sm-6">
                      <a href="{{route('posts.edit',$post->id)}}" class="btn btn-primary btn-lg btn-block"> edit</a>
                   </div>

                   <div class="col-sm-6">
                       <form action="{{route('posts.destroy',$post->id)}}" method="POST">
                           <button type="submit" class="btn btn-danger btn-lg btn-block">Delete </button>
                           <input type="hidden" name="_token" value="{{csrf_token()}}">
                           <input type="hidden" name="_method" value="DELETE">

                       </form>
                   </div>
               </div>
               <div class="row">
                    <div class="col-md-12">
                        <a href="{{ route('posts.index')}}" class="btn-default btn btn-block"> << see all posts</a>
                    </div>
               </div>



           </div>
       </div>

   </div>

@endsection