@extends("base")

@section("body")
<form method="POST" action="{{route('post.store')}}" enctype="multipart/form-data">
    @method('POST')
    @csrf
<div style="margin-top:20px;" class="input-group mb-3">
  <div class="input-group-prepend">
    <span class="input-group-text">Качи снимка</span>
  </div>
  <div class="custom-file">
    <input name="photo" type="file" class="custom-file-input" id="inputGroupFile01">
    <label class="custom-file-label" for="inputGroupFile01">Избери снимка</label>
  </div>
</div>

<div class="input-group mb-3">
  <div class="input-group-prepend">
    <span class="input-group-text" id="basic-addon1">Заглавие</span>
  </div>
  <input name="title" type="text" class="form-control" value="{{old('title')}}" placeholder="" aria-label="Username" aria-describedby="basic-addon1">
</div>

<div class="input-group">
  <div class="input-group-prepend">
    <span class="input-group-text">Съдържание</span>
  </div>
  <textarea id="editor" name="body" class="form-control" aria-label="With textarea">{{old('description')}}</textarea>
</div>
<br>
<label for="cars">Избери категория</label>

<select name="category_id">
  @foreach ($categories as $category)
  <option value="{{$category->id}}">{{$category->name}}</option>
  @endforeach
</select> 

<div style="text-align:center;">
<button type="submit" class="btn btn-success">Качи</button>
</div>
<br>
<script src="https://cdn.ckeditor.com/ckeditor5/11.0.1/classic/ckeditor.js"></script>
<script>
        ClassicEditor
            .create( document.querySelector( '#editor' ) )
            .catch( error => {
                console.error( error );
            } );
    </script>

</form>

@endsection