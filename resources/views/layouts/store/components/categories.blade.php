@foreach($subCategories as $subCategory)
        <ul style="margin-left:50px; width:300px;" class="list-group">
        <div class="btn-group" role="group" aria-label="Basic example">
          <li class="list-group-item">{{$subCategory->name}}</li>
          @if($subCategory->imageable_type == 'App\Product')
            <div> <a href="{{route('product-categories.edit', ['product_category' => $subCategory->id])}}" class="btn btn-secondary">Редактиране</a></div>
          @else
          <div> <a href="{{route('post-categories.edit', ['id' => $subCategory->id])}}" class="btn btn-secondary">Редактиране</a></div>

          @endif
          </div>
          @include('layouts.store.components.categories', ['subCategories' => $subCategory->subCategories])
        </ul>       
@endforeach