@extends("base")

@section("body")

    <div style="text-align:center;">
        <form method="POST" action="{{route('post-categories.store')}}" enctype="multipart/form-data">
    @method('POST')
    @csrf
{{csrf_field()}}
<div style="margin-top:20px;" class="input-group mb-3">
<input type="hidden" id="custId" name="type" value="App\Post"> 
<div class="input-group mb-3">
  <div class="input-group-prepend">
    <span class="input-group-text" id="basic-addon1">{{__('post.title')}}</span>
  </div>
  <input name="name" type="text" class="form-control" placeholder="" aria-label="Username" aria-describedby="basic-addon1">
</div>

<div class="input-group mb-3">
  <div class="input-group-prepend">
    <span class="input-group-text" id="basic-addon1">{{__('post.slug')}}</span>
  </div>
  <input name="slug" type="text" class="form-control" placeholder="" aria-label="Username" aria-describedby="basic-addon1">
</div>

<div class="input-group">
  <div class="input-group-prepend">
    <span class="input-group-text">{{__('post.description')}}</span>
  </div>
  <textarea name="description" class="form-control" aria-label="With textarea"></textarea>
</div>

<div style="text-align:center;" class="input-group">
<label for="cars">{{__('post.choose_parent_directory')}}:</label>
<select name="category_id">
    <option value="0">{{__('post.without_category')}}</option>
    @foreach ($post_categories as $post_category)
        <option value="{{$post_category->id}}">{{$post_category->name}}</option>
    @endforeach
</select> 
</div>

<br>
<div class="input-group mb-3">
  <div class="input-group-prepend">
   
  </div>
 
</div>

<div style="text-align:center;">
<button type="submit" class="btn btn-success">{{__('post.upload')}}</button>
</div>
<br>

</form>
    </div>

@endsection