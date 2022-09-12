@extends("base")

@section("body")

    <div style="text-align:center;">
        <form method="POST" action="{{route('product-categories.update', ['product_category' => $post_category->id])}}" enctype="multipart/form-data">
    @method('PUT')
    @csrf
{{csrf_field()}}
<div style="margin-top:20px;" class="input-group mb-3">

<div class="input-group mb-3">
  <div class="input-group-prepend">
    <span class="input-group-text" id="basic-addon1">Заглавие</span>
  </div>
  <input name="name" type="text" class="form-control" value="{{$post_category->name}}" placeholder="" aria-label="Username" aria-describedby="basic-addon1">
</div>

<div class="input-group mb-3">
  <div class="input-group-prepend">
    <span class="input-group-text" id="basic-addon1">Slug</span>
  </div>
  <input name="slug" type="text" class="form-control" value="{{$post_category->slug}}" placeholder="" aria-label="Username" aria-describedby="basic-addon1">
</div>

<div class="input-group">
  <div class="input-group-prepend">
    <span class="input-group-text">Описание</span>
  </div>
  <textarea name="description" class="form-control" aria-label="With textarea">{{$post_category->description}}</textarea>
</div>

<div style="text-align:center;" class="input-group">
<label for="cars">Избери родителска категория:</label>
<select name="category_id">
    @if($post_category->category_id == 0)
    <option selected="selected" value="0">Без категория</option>
    @else
    <option  value="0">Без категория</option>
    @endif
    
   
    @foreach ($post_categories as $category)
    @if ($post_category->id == $category->id && $post_category->category_id != 0)
        <option selected="selected" value="{{$post_category->parent->id}}">{{$post_category->parent->name}}</option>
    @else
    @if($post_category->category_id != 0)
        @if (($category->id != $post_category->parent->id))
            <option value="{{$category->id}}">{{$category->name}}</option>
        @endif
        @else
        @if($category->id != $post_category->id)
        <option value="{{$category->id}}">{{$category->name}}</option>
        @endif
    @endif
    @endif
       
    @endforeach
</select> 
</div>
</div>

<br>


<div style="text-align:center;">
<button type="submit" class="btn btn-success">Запамети</button>
</div>
<br>

</form>
<div style="text-align:center;">
<form action="{{route('post-categories.destroy', ['post_category' => $post_category->id])}}" method="Post"  enctype="multipart/form-data">
@csrf
@method('DELETE')
<button class="btn btn-danger" type="submit">Изтрий</button>
</form>
    </div>
    <br>

@endsection