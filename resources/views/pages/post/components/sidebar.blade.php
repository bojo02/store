@foreach($subCategories as $subCategory)
        <ul style="margin-left:15px;" class="list-menu">
        <li><a href="{{route('category.posts', ['id' => $subCategory->slug])}}">{{$subCategory->name}}</li></a>
         
          @include('pages.post.components.sidebar', ['subCategories' => $subCategory->subCategories])
          </ul>     
@endforeach