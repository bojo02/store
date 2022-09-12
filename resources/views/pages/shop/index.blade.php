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
				<h6 class="title">{{__('shop.category')}}</h6>
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
						<li><a href="{{route('category.products', ['id' => $category->slug])}}">{{$category->name}}  </a></li>
						@include('layouts.store.components.category_shop_sidebar', ['subCategories' => $category->subCategories])
						@endif
					@endforeach
				</ul>

			</div> <!-- card-body.// -->
		</div>
	</article> <!-- filter-group  .// -->
	<!--
	<article class="filter-group">
		<header class="card-header">
			<a href="#" data-toggle="collapse" data-target="#collapse_2" aria-expanded="true" class="">
				<i class="icon-control fa fa-chevron-down"></i>
				<h6 class="title">Brands </h6>
			</a>
		</header>

	</article>
	<article class="filter-group">
		<header class="card-header">
			<a href="#" data-toggle="collapse" data-target="#collapse_3" aria-expanded="true" class="">
				<i class="icon-control fa fa-chevron-down"></i>
				<h6 class="title">Price range </h6>
			</a>
		</header>
		<div class="filter-content collapse show" id="collapse_3" style="">
			<div class="card-body">
				<input type="range" class="custom-range" min="0" max="100" name="">
				<div class="form-row">
				<div class="form-group col-md-6">
				  <label>Min</label>
				  <input class="form-control" placeholder="$0" type="number">
				</div>
				<div class="form-group text-right col-md-6">
				  <label>Max</label>
				  <input class="form-control" placeholder="$1,0000" type="number">
				</div>
				</div> 
				<button class="btn btn-block btn-primary">Apply</button>
			</div>
		</div>
	</article> 
	<article class="filter-group">
		<header class="card-header">
			<a href="#" data-toggle="collapse" data-target="#collapse_4" aria-expanded="true" class="">
				<i class="icon-control fa fa-chevron-down"></i>
				<h6 class="title">Sizes </h6>
			</a>
		</header>
		<div class="filter-content collapse show" id="collapse_4" style="">
			<div class="card-body">
			  <label class="checkbox-btn">
			    <input type="checkbox">
			    <span class="btn btn-light"> XS </span>
			  </label>

			  <label class="checkbox-btn">
			    <input type="checkbox">
			    <span class="btn btn-light"> SM </span>
			  </label>

			  <label class="checkbox-btn">
			    <input type="checkbox">
			    <span class="btn btn-light"> LG </span>
			  </label>

			  <label class="checkbox-btn">
			    <input type="checkbox">
			    <span class="btn btn-light"> XXL </span>
			  </label>
		</div>
		</div>
	</article> 
	<article class="filter-group">
		<header class="card-header">
			<a href="#" data-toggle="collapse" data-target="#collapse_5" aria-expanded="false" class="">
				<i class="icon-control fa fa-chevron-down"></i>
				<h6 class="title">More filter </h6>
			</a>
		</header>
		<div class="filter-content collapse in" id="collapse_5" style="">
			<div class="card-body">
				<label class="custom-control custom-radio">
				  <input type="radio" name="myfilter_radio" checked="" class="custom-control-input">
				  <div class="custom-control-label">Any condition</div>
				</label>

				<label class="custom-control custom-radio">
				  <input type="radio" name="myfilter_radio" class="custom-control-input">
				  <div class="custom-control-label">Brand new </div>
				</label>

				<label class="custom-control custom-radio">
				  <input type="radio" name="myfilter_radio" class="custom-control-input">
				  <div class="custom-control-label">Used items</div>
				</label>

				<label class="custom-control custom-radio">
				  <input type="radio" name="myfilter_radio" class="custom-control-input">
				  <div class="custom-control-label">Very old</div>
				</label>
			</div>
		</div>
	</article> -->
</div> 

	</aside>
	<main class="col-md-9">

<header class="border-bottom mb-4 pb-3">
		<div class="form-inline">
			<span class="mr-md-auto">{{$products->count()}} {{__('shop.product_count')}}</span>

		
		</div>
</header><!-- sect-heading -->

<div class="row">
	@include("pages/shop/components/products")
</div> <!-- row end.// -->


<nav class="mt-4" aria-label="Page navigation sample">
  <ul class="pagination">
    <li class="page-item"><a class="page-link" href="{{$products->previousPageUrl()}}">{{__('shop.pagination_back')}}</a></li>
	@if($products->currentPage() - 1 >= 3)
	<li class="page-item"><a class="page-link" href="/shop?page=1">1</a></li>
	
	@endif
	@if($products->currentPage()-1 >= 2)
	<li class="page-item"><a class="page-link" href="/shop?page={{$products->currentPage()-2}}">{{$products->currentPage()-2}}</a></li>
	@endif
	@if($products->currentPage()-1 >= 1)
	<li class="page-item"><a class="page-link" href="/shop?page={{$products->currentPage()-1}}">{{$products->currentPage()-1}}</a></li>
	@endif

    <li class="page-item active"><a class="page-link" href="/shop?page={{$products->currentPage()}}">{{$products->currentPage()}}</a></li>

	@if($products->lastPage() - $products->currentPage() >= 1)
	<li class="page-item"><a class="page-link" href="/shop?page={{$products->currentPage()+1}}">{{$products->currentPage()+1}}</a></li>
	@endif
	@if($products->lastPage() - $products->currentPage() >= 2)
	<li class="page-item"><a class="page-link" href="/shop?page={{$products->currentPage()+2}}">{{$products->currentPage()+2}}</a></li>
	@endif

	@if($products->lastPage() - $products->currentPage() >= 3)
	
	<li class="page-item"><a class="page-link" href="/shop?page={{$products->lastPage()}}">{{$products->lastPage()}}</a></li>
	@endif
	
    <li class="page-item"><a class="page-link" href="{{$products->nextPageUrl()}}">{{__('shop.pagination_forward')}}</a></li>
	
  </ul>
</nav>

	</main>
	</div>
</div>
  
@endsection