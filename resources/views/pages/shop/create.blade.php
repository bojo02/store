@extends("base")

@section("body")
<form method="POST" action="{{route('shop.store')}}" enctype="multipart/form-data">
    @method('POST')
    @csrf
{{csrf_field()}}
<div style="margin-top:20px;" class="input-group mb-3">
  <div class="input-group-prepend">
    <span class="input-group-text">{{__('shop.upload_image')}}</span>
  </div>
  <div class="custom-file">
    <input name="photo" type="file" class="custom-file-input" id="inputGroupFile01">
    <label class="custom-file-label" for="inputGroupFile01">{{__('shop.choose_image')}}</label>
  </div>
</div>

<div class="input-group mb-3">
  <div class="input-group-prepend">
    <span class="input-group-text" id="basic-addon1">{{__('shop.title')}}</span>
  </div>
  <input name="title" type="text" class="form-control" value="{{old('title')}}" placeholder="" aria-label="Username" aria-describedby="basic-addon1">
</div>

<div class="input-group mb-3">
  <div class="input-group-prepend">
    <span class="input-group-text" id="basic-addon1">{{__('shop.short_description')}}</span>
  </div>
  <input name="short_description" type="text" value="{{old('short_description')}}" class="form-control" placeholder="" aria-label="Username" aria-describedby="basic-addon1">
</div>

<div class="input-group">
  <div class="input-group-prepend">
    <span class="input-group-text">{{__('shop.long_description')}}</span>
  </div>
  <textarea name="description" class="form-control" aria-label="With textarea">{{old('description')}}</textarea>
</div>
<br>
<div class="input-group mb-3">
  <div class="input-group-prepend">
    <span class="input-group-text" id="basic-addon1">{{__('shop.price')}}</span>
  </div>
  <input name="price" value="{{old('price')}}" type="text" class="form-control" placeholder="" aria-label="Username" aria-describedby="basic-addon1">
</div>
<label for="cars">{{__('shop.choose_category')}}</label>

<select name="category_id">
  @foreach ($categories as $category)
  <option value="{{$category->id}}">{{$category->name}}</option>
  @endforeach
</select> 

<div style="text-align:center;">
<button type="submit" class="btn btn-success">{{__('shop.upload')}}</button>
</div>
<br>

</form>
@endsection