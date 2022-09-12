@extends("base")

@section("body")

<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!------ Include the above in your HEAD tag ---------->

  <link rel="stylesheet" href="https://fontawesome.com/v4.7.0/assets/font-awesome/css/font-awesome.css">


<div class="container">
	<div class="row">
	<aside class="col-md-3">
		
<div class="card">
	<article class="filter-group">
		<header class="card-header">
				<i class="icon-control fa fa-chevron-down"></i>
				<h6 class="title">{{__('post.categories')}}</h6>
		</header>
		<div class="filter-content collapse show" id="collapse_1" style="">
			<div class="card-body">
				<form class="pb-3">
				<div class="input-group">
				  <input type="text" class="form-control" placeholder="Search">
				  <div class="input-group-append">
				    <button class="btn btn-light" type="button"><i class="fa fa-search"></i></button>
				  </div>
				</div>
				</form>
				
				<ul class="list-menu">
					@foreach ($categories as $category)
						@if($category->category_id == 0)
						<li><a href="{{route('category.posts', ['id' => $category->slug])}}">{{$category->name}}  </a></li>
						@include('pages.post.components.sidebar', ['subCategories' => $category->subCategories])
						@endif
					@endforeach
				</ul>

			</div> <!-- card-body.// -->
		</div>
	</article> <!-- filter-group  .// -->
	<article class="filter-group">


	</article> <!-- filter-group .// -->


	</aside>
	<main class="col-md-9">

<header class="border-bottom mb-4 pb-3">
		<div class="form-inline">
			<span class="mr-md-auto">{{$posts->count()}} {{__('post.number_posts')}}</span>

		
		</div>
</header><!-- sect-heading -->

<div style='margin-top:20px;' class="row">
@foreach ($posts as $post)
        <div style='margin-top:20px;' class="col-sm">
            <div class="card" style="width: 18rem;">
			<a href="{{route('post.show', ['post' => $post->slug])}}" >
                <img class="card-img-top" src="{{asset($post->image->path)}}" alt="">
			</a>
                <div class="card-body">
                    <h5 class="card-title">{{$post->title}}</h5>
                    <p class="card-text">{!! $post->body !!}</p>
                    <a href="{{route('post.show', ['post' => $post->slug])}}" class="btn btn-primary">{{__('post.look')}}</a>
                </div>
            </div>
        </div>
      @endforeach

</div> <!-- row end.// -->


<nav class="mt-4" aria-label="Page navigation sample">
  <ul class="pagination">
    <li class="page-item"><a class="page-link" href="{{$posts->previousPageUrl()}}">{{__('shop.pagination_back')}}</a></li>
	@if($posts->currentPage() - 1 >= 3)
	<li class="page-item"><a class="page-link" href="/shop?page=1">1</a></li>
	
	@endif
	@if($posts->currentPage()-1 >= 2)
	<li class="page-item"><a class="page-link" href="/shop?page={{$posts->currentPage()-2}}">{{$posts->currentPage()-2}}</a></li>
	@endif
	@if($posts->currentPage()-1 >= 1)
	<li class="page-item"><a class="page-link" href="/shop?page={{$posts->currentPage()-1}}">{{$posts->currentPage()-1}}</a></li>
	@endif

    <li class="page-item active"><a class="page-link" href="/shop?page={{$posts->currentPage()}}">{{$posts->currentPage()}}</a></li>

	@if($posts->lastPage() - $posts->currentPage() >= 1)
    <li class="page-item"><a class="page-link" href="/shop?page={{$posts->currentPage()+1}}">{{$posts->currentPage()+1}}</a></li>
    @endif
	@if($posts->lastPage() - $posts->currentPage() >= 2)
	<li class="page-item"><a class="page-link" href="/shop?page={{$posts->currentPage()+2}}">{{$posts->currentPage()+2}}</a></li>
	@endif

	@if($posts->lastPage() - $posts->currentPage() >= 3)
	
	<li class="page-item"><a class="page-link" href="/shop?page={{$posts->lastPage()}}">{{$posts->lastPage()}}</a></li>
	@endif
	
    <li class="page-item"><a class="page-link" href="{{$posts->nextPageUrl()}}">{{__('shop.pagination_forward')}}</a></li>
	
  </ul>
</nav>

	</main>
	</div>
</div>
  
@endsection