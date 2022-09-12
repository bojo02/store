@extends("base")

@section("body")
<br></br>
    @if(!empty($product_categories))
    
    <ul style="width:300px;" class="list-group">
      @foreach ($product_categories as $product_category)
      @if($product_category->category_id == 0)
        <div class="btn-group" role="group" aria-label="Basic example">
          <li class="list-group-item">{{$product_category->name}}</li>
          <div> <a href="{{route('product-categories.edit', ['product_category' => $product_category->id])}}" class="btn btn-secondary">Редактиране</a></div>
         
        </div>
        @include('pages.product_categories.components.categories', ['subCategories' => $product_category->subCategories])
        @endif
      @endforeach
    </ul>
   
      <div style="text-align:center;">
      <br></br>

        <a class="btn btn-primary" href="{{route('product-categories.create')}}" role="button">Добави</a>

        <br></br>
    </div>

    @else
    <div style="text-align:center;">
        <p>Няма създадени категории...</p>

        <a class="btn btn-primary" href="{{route('product-categories.create')}}" role="button">Добави</a>

        <br></br>
    </div>

   
    @endif

@endsection