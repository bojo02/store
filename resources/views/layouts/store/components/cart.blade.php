
    @if(session('cart'))
      {{count(session()->get('cart'))}}
    @else
      0
    @endif

