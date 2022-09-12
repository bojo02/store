@extends("base")

@section("body")
<br></br>
    @if(!empty($post_categories))
    
    <ul style="width:300px;" class="list-group">
      @foreach ($post_categories as $post_category)
      @if($post_category->category_id == 0)
        <div class="btn-group" role="group" aria-label="Basic example">
          <li class="list-group-item">{{$post_category->name}}</li>
          <div> <a href="{{route('post-categories.edit', ['post_category' => $post_category->id])}}" class="btn btn-secondary">Редактиране</a></div>
         
        </div>
        @include('pages.post_categories.components.categories', ['subCategories' => $post_category->subCategories])
        @endif
      @endforeach
    </ul>
   
      <div style="text-align:center;">
      <br></br>

        <a class="btn btn-primary" href="{{route('post-categories.create')}}" role="button">Добави</a>

        <br></br>
    </div>

    @else
    <div style="text-align:center;">
        <p>Няма създадени категории...</p>

        <a class="btn btn-primary" href="{{route('post-categories.create')}}" role="button">Добави</a>

        <br></br>
    </div>

   
    @endif

@endsection