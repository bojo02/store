@foreach ($products as $product)
<div class="col-md-4">
		<figure class="card card-product-grid">
			<div class="img-wrap"> 
				<!--<span class="badge badge-danger"> NEW </span>-->
								<a href="{{route('shop.show', ['shop'=> $product->slug])}}"><img src="{{asset($product->photo->path)}}" class="img-fluid"></a>
                                
				<!--<a class="btn-overlay" href="#"><i class="fa fa-search-plus"></i> Quick view</a>-->
			</div> <!-- img-wrap.// -->
			<figcaption class="info-wrap">
				<div class="fix-height">
					<a href="{{route('shop.show', ['shop'=> $product->slug])}}" class="title">{{$product->title}}</a>
					<div class="price-wrap mt-2">
						<span class="price">{{$product->price}}{{__('shop.leva')}}</span>
						<!-- <del class="price-old">$1980</del>-->
					</div> <!-- price-wrap.// -->
				</div>
				


				<a href="{{route('shop.show', ['shop'=> $product->slug])}}" class="btn btn-block btn-primary"> {{__('shop.look')}} </a>

				<form id="add-to-cart" method="POST" >
					<input id="id" type="hidden" id="custId" name="id"> 
                	<button id="{{$product->id}}" type="submit" class="btn btn-block btn-success">{{ __('shop.add_to_cart') }} </button>
				</form>
			</figcaption>
		</figure>
	</div> <!-- col.// -->



@endforeach


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