@foreach($subCategories as $subCategory)
        <ul style="margin-left:15px;" class="list-menu">
        <li><a href="{{route('category.products', ['id' => $subCategory->slug])}}">{{$subCategory->name}}</li></a>
         
          @include('layouts.store.components.category_shop_sidebar', ['subCategories' => $subCategory->subCategories])
          </ul>     
@endforeach