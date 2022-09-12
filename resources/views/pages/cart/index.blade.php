@extends("base")

@section("body")



<section class="h-100 gradient-custom">
  <div class="container py-5">
    <div class="row d-flex justify-content-center my-4">
      <div class="col-md-8">
        <div class="card mb-4">
          <div class="card-header py-3">
            <h5 class="mb-0">Количка - @if(session('cart'))
      {{count(session()->get('cart'))}}
    @else
      0
    @endif артикул/а</h5>
          </div>
          <div class="card-body">
            <!-- Single item -->
            

            <hr class="my-4" />

<form action="{{route('updatecartelement')}}" method="POST" enctype="multipart/form-data" >
{!! csrf_field() !!}           
 @if(session('cart'))
    @foreach(session('cart') as $id => $details)
  <!-- Single item -->
            <div class="row">
              <div class="col-lg-3 col-md-12 mb-4 mb-lg-0">
                <!-- Image -->
                <div class="bg-image hover-overlay hover-zoom ripple rounded" data-mdb-ripple-color="light">
                  <img src="{{asset($details['photo'])}}"
                    class="w-100" />
                  <a href="#!">
                    <div class="mask" style="background-color: rgba(251, 251, 251, 0.2)"></div>
                  </a>
                </div>
                <!-- Image -->
              </div>

              <div class="col-lg-5 col-md-6 mb-4 mb-lg-0">
                <!-- Data -->
                <p><strong>ID: {{$details['id']}}</strong></p>
                <input id="id[]" type="hidden" id="custId" name="id[]" value="{{$details['id']}}"> 
                <p><strong>{{$details['name']}}</strong></p>
                <a  class="btn btn-primary btn-sm me-1 mb-2" href="{{route('clearcartelement', ['id' => $details['id']])}}" role="button"title="Remove item">
                  
                  <i class="fas fa-trash"></i>
                  </a>
                <!-- Data -->
              </div>

              <div class="col-lg-4 col-md-6 mb-4 mb-lg-0">
                <!-- Quantity -->
                <div class="d-flex mb-4" style="max-width: 300px">
                 

                  <div class="form-outline">
                    <input id="quantity[]" min="0" name="quantity[]" value="{{$details['quantity']}}" type="number" class="form-control" />
                    <label class="form-label" for="form1">Количество</label>
                  </div>

                  
                </div>
                <!-- Quantity -->

                <!-- Price -->
                <p class="text-start text-md-center">
                  <strong>{{ $details['price'] * $details['quantity'] }}лв.</strong>
                </p>
                <!-- Price -->
              </div>
            </div>
            <hr class="my-4" />
            @endforeach
            <div style="text-align:center;"><button type="submit" class="btn btn-success">Запази</button></div>
          </form>
            <br>

            <p  style="text-align:center;"><a  class="btn btn-primary" href="{{route('clearcart')}}" role="button">Изчисти количката</a></p>
            @else
<p style="text-align:center;">Количката е празна...</p>
@endif






            <!-- Single item -->
          </div>
        </div>
        <div class="card mb-4">
          <div class="card-body">
            <p><strong>Expected shipping delivery</strong></p>
            <p class="mb-0">12.10.2020 - 14.10.2020</p>
          </div>
        </div>
        <div class="card mb-4 mb-lg-0">
          <div class="card-body">
            <p><strong>We accept</strong></p>
            <img class="me-2" width="45px"
              src="https://mdbcdn.b-cdn.net/wp-content/plugins/woocommerce-gateway-stripe/assets/images/visa.svg"
              alt="Visa" />
            <img class="me-2" width="45px"
              src="https://mdbcdn.b-cdn.net/wp-content/plugins/woocommerce-gateway-stripe/assets/images/amex.svg"
              alt="American Express" />
            <img class="me-2" width="45px"
              src="https://mdbcdn.b-cdn.net/wp-content/plugins/woocommerce-gateway-stripe/assets/images/mastercard.svg"
              alt="Mastercard" />
            <img class="me-2" width="45px"
              src="https://mdbcdn.b-cdn.net/wp-content/plugins/woocommerce/includes/gateways/paypal/assets/images/paypal.webp"
              alt="PayPal acceptance mark" />
          </div>
        </div>
      </div>
      <div class="col-md-4">
        <div class="card mb-4">
          <div class="card-header py-3">
            <h5 class="mb-0">Плащане</h5>
          </div>
          <div class="card-body">
            <ul class="list-group list-group-flush">
              <li
                class="list-group-item d-flex justify-content-between align-items-center border-0 px-0 pb-0">
              <li
                class="list-group-item d-flex justify-content-between align-items-center border-0 px-0 mb-3">
                <div>
                  <strong>Крайна цена:</strong>
                </div>
                <span><strong>{{$total}}лв.</strong></span>
              </li>
            </ul>
            <form action="{{route('checkout')}}" method="GET">
              <button type="submit" class="btn btn-primary btn-lg btn-block">
                Приключване
              </button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>







@endsection