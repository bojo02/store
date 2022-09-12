

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo03" aria-controls="navbarTogglerDemo03" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <a class="navbar-brand" href="{{route('index')}}">DressCode.BG</a>

  <div class="collapse navbar-collapse" id="navbarTogglerDemo03">
    <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
      <li class="nav-item active">
        <a class="nav-link" href="{{route('index')}}">{{__('shop.home')}} <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="{{route('shop.index')}}">{{__('shop.shop')}}</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="{{route('blog.index')}}">Блог</a>
      </li>
  
    </ul>
    <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
  
    <form class="form-inline my-2 my-lg-0">
      <li class="nav-item">
        <input class="form-control mr-sm-2" type="search" placeholder="{{__('shop.search')}}..." aria-label="Търсене...">
        <button class="btn btn-outline-success my-2 my-sm-0" type="submit">{{__('shop.search')}}</button>
      </li>
    </form>
    
      @if(Auth::user())
      <li style="margin-left:15px;" class="nav-item">
        <a class="btn btn-danger" href="/logout">{{__('auth.logout')}}</a>
      </li>
      @else
      <li style="margin-left:15px;" class="nav-item">
          <a class="btn btn-primary" href="/login">{{__('auth.login')}}</a>
      </li>
      <li style="margin-left:15px;" class="nav-item">
          <a class="btn btn-success" href="/register">Регистрация</a>
      </li>
      @endif
    </ul>

    <p>
		
	<a href="{{route('cart')}}">
		<i class="fas fa-shopping-cart" style="font-size:30px"></i>
    <span class="cart-number">
   @include('layouts.store.components.cart')
</span>
    
</a>


	
	</p>
  </div>
  
</nav>