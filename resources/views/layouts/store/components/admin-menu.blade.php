<nav class="navbar navbar-expand-sm bg-light navbar-light">
  <ul class="navbar-nav">
    <li class="nav-item dropdown">
      <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
      {{__('shop.shop')}}
      </a>
      <div class="dropdown-menu">
        <a class="dropdown-item" href="{{route('shop.create')}}">{{__('shop.add_product')}}</a>
        <a class="dropdown-item" href="{{route('product-categories.index')}}">{{__('shop.add_category')}}</a>
      </div>
    </li>
    <li class="nav-item dropdown">
      <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
      Блог
      </a>
      <div class="dropdown-menu">
        <a class="dropdown-item" href="{{route('post.create')}}">Добави статия</a>
        <a class="dropdown-item" href="{{route('post-categories.index')}}">Добави категория</a>
      </div>
    </li>
    <li>
    <a class="dropdown-item" href="{{route('order.index')}}">Поръчки</a>
    </li>
  </ul>
</nav> 
