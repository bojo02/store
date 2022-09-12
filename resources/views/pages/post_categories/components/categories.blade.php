@foreach($subCategories as $subCategory)
        <ul style="margin-left:50px; width:300px;" class="list-group">
        <div class="btn-group" role="group" aria-label="Basic example">
          <li class="list-group-item">{{$subCategory->name}}</li>
          <div> <a href="{{route('post-categories.edit', ['post_category' => $subCategory->id])}}" class="btn btn-secondary">Редактиране</a></div>
          </div>
          @include('pages.post_categories.components.categories', ['subCategories' => $subCategory->subCategories])
        </ul>       
@endforeach