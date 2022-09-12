@extends("base")

@section("body")

    <div style="text-align:center;">
        <form method="POST" action="{{route('product-categories.store')}}" enctype="multipart/form-data">
    @method('POST')
    @csrf
{{csrf_field()}}
<div style="margin-top:20px;" class="input-group mb-3">
<input type="hidden" id="custId" name="type" value="App\Product"> 
<div class="input-group mb-3">
  <div class="input-group-prepend">
    <span class="input-group-text" id="basic-addon1">Заглавие</span>
  </div>
  <input name="name" type="text" class="form-control" placeholder="" aria-label="Username" aria-describedby="basic-addon1">
</div>

<div class="input-group mb-3">
  <div class="input-group-prepend">
    <span class="input-group-text" id="basic-addon1">Slug</span>
  </div>
  <input name="slug" type="text" class="form-control" placeholder="" aria-label="Username" aria-describedby="basic-addon1">
</div>

<div class="input-group">
  <div class="input-group-prepend">
    <span class="input-group-text">Описание</span>
  </div>
  <textarea name="description" class="form-control" aria-label="With textarea"></textarea>
</div>

<div style="text-align:center;" class="input-group">
<label for="cars">Избери родителска категория:</label>
<select name="category_id">
    <option value="0">Без категория</option>
    @foreach ($product_categories as $product_category)
        <option value="{{$product_category->id}}">{{$product_category->name}}</option>
    @endforeach
</select> 
</div>

<br>
<div class="input-group mb-3">
  <div class="input-group-prepend">
   
  </div>
 
</div>

<div style="text-align:center;">
<button type="submit" class="btn btn-success">Качи</button>
</div>
<br>

</form>
    </div>

@endsection