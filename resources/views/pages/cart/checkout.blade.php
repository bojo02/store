@extends("base")

@section("body")
 <div class="container">         
         <div class="row">
        
            <div class="col-md-6 col-md-offset-3">
               <div class="panel panel-default credit-card-box">
                  <div class="panel-heading" >
                     <div class="row">
                        <h3>Разплащане</h3>                        
                     </div>
                  </div>
                  <div class="panel-body">
                     @if (Session::has('alert_success'))
                     <div class="alert alert-success text-center">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                        <p>{{ Session::get('alert_success') }}</p><br>
                     </div>
                     @endif
                     <br>
                     <form role="form" action="{{ route('stripe.post') }}" method="post" class="require-validation" data-cc-on-file="false" data-stripe-publishable-key="{{ env('STRIPE_KEY') }}" id="payment-form">
                        @csrf

                        <input type="hidden" id="custId" name="amount" value="{{$total}}"> 

                        <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="firstName">Име</label>
                        <input type="text" class="form-control" namespace="firstname" placeholder="" value="" required="">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="lastName">Фамилия</label>
                        <input type="text" class="form-control"  name="lastname" id="lastName" placeholder="" value="" required="">
                    </div>
                </div>
                <div class="mb-3">
                    <label for="email">Имейл <span class="text-muted"></span></label>
                    <input type="email" class="form-control" name="email" placeholder="you@example.com">
                </div>
                <div class="mb-3">
                    <label for="address">Адрес</label>
                    <input type="text" class="form-control" name="address" id="address" placeholder="Никола Вапцаров 83" required="">
                </div>
                <div class="mb-3">
                    <label for="address">Телефон</label>
                    <input type="text" class="form-control" name="phone" id="phone" placeholder="" required="">
                </div>
                <div class="row">
                    <div class="col-md-5 mb-3">
                        <label for="country">Държава</label>
                        <select class="custom-select d-block w-100" name="country" id="country" >
                            <option value="bg">България</option>
                        </select>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="state">Град</label>
                        <select class="custom-select d-block w-100" name="city" id="state" >
                            <option value="Plovdiv">Пловдив</option>
                            <option  value="Sofiq">София</option>
                        </select>                    
                    </div>
                    <div class="col-md-3 mb-3">
                        <label for="zip">Пощенски код</label>
                        <input type="text" class="form-control" id="postal_code" name="postal_code" placeholder="" required="">
                    </div>
                </div>
                        <div class='form-row row'>
                           <div class='col-xs-12 col-md-6 form-group required'>
                              <label class='control-label'>Име на картата</label> 
                              <input class='form-control' size='4' type='text'>
                           </div>
                           <div class='col-xs-12 col-md-6 form-group required'>
                              <label class='control-label'>Номер на картата</label> 
                              <input autocomplete='off' class='form-control card-number' size='20' type='text'>
                           </div>                           
                        </div>                        
                        <div class='form-row row'>
                           <div class='col-xs-12 col-md-4 form-group cvc required'>
                              <label class='control-label'>CVC</label> 
                              <input autocomplete='off' class='form-control card-cvc' placeholder='ex. 311' size='4' type='text'>
                           </div>
                           <div class='col-xs-12 col-md-4 form-group expiration required'>
                              <label class='control-label'>Месец</label> 
                              <input class='form-control card-expiry-month' placeholder='MM' size='2' type='text'>
                           </div>
                           <div class='col-xs-12 col-md-4 form-group expiration required'>
                              <label class='control-label'>Година</label> 
                              <input class='form-control card-expiry-year' placeholder='YYYY' size='4' type='text'>
                           </div>
                        </div>                     
                        <div class="form-row row">
                           <div class="col-xs-12">
                              <button class="btn btn-primary btn-lg btn-block" type="submit">Плащане</button>
                           </div>
                        </div>
                     </form>
                     <br>
                  </div>
               </div>
            </div>
         </div>
      </div>

<script type="text/javascript" src="https://js.stripe.com/v2/"></script>
<script type="text/javascript">
$(function() {
    var $form = $(".require-validation");
    $('form.require-validation').bind('submit', function(e) {
        var $form = $(".require-validation"),
        inputSelector = ['input[type=email]', 'input[type=password]', 'input[type=text]', 'input[type=file]', 'textarea'].join(', '),
        $inputs = $form.find('.required').find(inputSelector),
        $errorMessage = $form.find('div.error'),
        valid = true;
        $errorMessage.addClass('hide');
        $('.has-error').removeClass('has-error');
        $inputs.each(function(i, el) {
            var $input = $(el);
            if ($input.val() === '') {
                $input.parent().addClass('has-error');
                $errorMessage.removeClass('hide');
                e.preventDefault();
            }
        });
        if (!$form.data('cc-on-file')) {
          e.preventDefault();
          Stripe.setPublishableKey($form.data('stripe-publishable-key'));
          Stripe.createToken({
              number: $('.card-number').val(),
              cvc: $('.card-cvc').val(),
              exp_month: $('.card-expiry-month').val(),
              exp_year: $('.card-expiry-year').val()
          }, stripeResponseHandler);
        }
    });

    function stripeResponseHandler(status, response) {
        if(response.error) {
            $('.error')
            .removeClass('hide')
            .find('.alert')
            .text(response.error.message);
        }else {
          /* token contains id, last4, and card type */
          var token = response['id'];
          $form.find('input[type=text]').empty();
          $form.append("<input type='hidden' name='stripeToken' value='" + token + "'/>");
          $form.get(0).submit();
        }
    }
});
</script>
@endsection