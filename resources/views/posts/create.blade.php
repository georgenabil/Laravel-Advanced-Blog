@extends('main')

@section('title', '| Create New Post')

@section('stylesheets')

	{!! Html::style('css/parsley.css') !!}
	{!! Html::style('css/select2.min.css') !!}
	<script src="//cdn.tinymce.com/4/tinymce.min.js"></script>

	<script>
		tinymce.init({
			selector: 'textarea',
			plugins: 'link code',
			menubar: false
		});
	</script>

@endsection

@section('content')

	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<h1>Create New Post</h1>
			<hr>

			   <form action="{{route('posts.store')}}" method="POST" data-parsley-validate>
				   <input type="hidden" name="_token" value="{{ csrf_token() }}">
				   <input type="hidden" name="_method" value="POST">
                  <label for="title">Title:</label>
				   <input class="form-control" name="title" maxlength="255" minlength="5" required >
				   <label for="slug">Slug:</label>
				   <input class="form-control" name="slug" maxlength="255" minlength="5" required >

				   <label>Category:</label>
				    <select class="form-control" name="category_id" required>
						@foreach($categories as $category)
						<option value="{{$category->id}}">{{ $category->name}}</option>
                       @endforeach

					</select>

				   <label>body:</label>
				   <textarea name="body" class="form-control" minlength="5" maxlength="225" ></textarea>

				   <button class="btn btn-success btn-lg btn-block" type="submit">Create Post</button>
			   </form>

		</div>
	</div>


@endsection


@section('scripts')

	{!! Html::script('js/parsley.min.js') !!}
	{!! Html::script('js/select2.min.js') !!}

	<script type="text/javascript">
		$('.select2-multi').select2();
	</script>

@endsection
