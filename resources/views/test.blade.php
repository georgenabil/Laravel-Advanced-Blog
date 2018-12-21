<html>

<header>


</header>
<body>


     <form action="{{URL::to('post/'.$post->id)}}" method="post">
         <input  type="hidden" name="_token" value="{{ csrf_token() }}">
         <input type="hidden" name="_method" value="PUT">

       <input type="text" name="slug" value="{{$post->slug}}">
       <button type="submit">Submit</button>
     </form>

   <a href="{{ route('m') }}"> kkkkkk</a>
     <p> {{url('post/'.$post->id)}}</p>

       @if( count($errors))
         <h1>{{ $errors->all() }}</h1>

        @endif

</body>
</html>