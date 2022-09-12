@extends('base')

@section('body')
<div style="margin-top:20px; margin-bottom:20px;" class="container">
		<div class="card">
			<div class="container-fliud">
				<div class="wrapper row">
					<div class="preview col-md-6">
						
						<div class="preview-pic tab-content">
						  <div class="tab-pane active" id="pic-1"><img src="{{asset($product->photo->path)}}" /></div>
						  <div class="tab-pane" id="pic-2"><img src="http://placekitten.com/400/252" /></div>
						  <div class="tab-pane" id="pic-3"><img src="http://placekitten.com/400/252" /></div>
						  <div class="tab-pane" id="pic-4"><img src="http://placekitten.com/400/252" /></div>
						  <div class="tab-pane" id="pic-5"><img src="http://placekitten.com/400/252" /></div>
						</div>
						<ul class="preview-thumbnail nav nav-tabs">
						  <li class="active"><a data-target="#pic-1" data-toggle="tab"><img src="{{asset($product->photo->path)}}" /></a></li>
						  <li><a data-target="#pic-2" data-toggle="tab"><img src="http://placekitten.com/200/126" /></a></li>
						  <li><a data-target="#pic-3" data-toggle="tab"><img src="http://placekitten.com/200/126" /></a></li>
						  <li><a data-target="#pic-4" data-toggle="tab"><img src="http://placekitten.com/200/126" /></a></li>
						  <li><a data-target="#pic-5" data-toggle="tab"><img src="http://placekitten.com/200/126" /></a></li>
						</ul>
						
					</div>
					<div class="details col-md-6">
						<h3 class="product-title">{{$product->title}}</h3>
						<div class="rating">
							<div class="stars">
								<span class="fa fa-star checked"></span>
								<span class="fa fa-star checked"></span>
								<span class="fa fa-star checked"></span>
								<span class="fa fa-star"></span>
								<span class="fa fa-star"></span>
							</div>
							
						</div>
						<p class="product-description">{{$product->description}}</p>
						<p class="product-description">{{$product->category->name}}</p>
						<h4 class="price">{{__('shop.price')}}: <span>{{$product->price}}{{__('shop.leva')}}</span></h4>
						<div class="action">
						<form id="add-to-cart" method="POST" >
					<input id="id" type="hidden" id="custId" name="id" "> 
                	<button id="{{$product->id}}" type="submit" class="btn btn-block btn-success">{{__('shop.add_to_cart')}}</button>
				</form>
							
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>


	<script type="text/javascript">

$('form button').on('click',function(e){
    e.preventDefault();

	let id = this.id;
	
	

                $.ajaxSetup({
                  headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                  }
});
    $.ajax({
		url: "{{route('addtocart')}}",
      type:"post",
      data:{
		id:id,
      },
      success: function(data) {
		$('.flash-message').html(data.alert);
		$('.cart-number').html(data.cart);
    },
      });
    });
  

  </script>

@endsection