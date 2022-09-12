<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
    <div style="text-align:center;">
    <h3>Your order was received: No:#{{$order_id}}</h3>
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
                    <label class="form-label" for="form1">Количество</label>
                    <label class="form-label" for="form1">{{$details['quantity']}}</label>
                    <strong>{{ $details['price'] * $details['quantity'] }}лв.</strong>

                  </div>

                  
                </div>

              </div>
            </div>
            <hr class="my-4" />
            @endforeach

            <span><strong>Крайна цена: {{$total}}лв.</strong></span>

    </div>
   </body>
</html>