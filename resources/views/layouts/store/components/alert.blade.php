@if(!empty($alert_success))
<div class="alert alert-success alert-dismissible fade show" role="alert">{{$alert_success}}
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
@endif
@if(session('alert_success'))
<div class="alert alert-success alert-dismissible fade show" role="alert"> {!! session('alert_success') !!}
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
@endif
@if(session('alert_danger'))
<div class="alert alert-danger alert-dismissible fade show" role="alert"> {!! session('alert_danger') !!}
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
@endif
@if($errors ?? ''->any())
@foreach ($errors ?? ''->all() as $error)
<div class="alert alert-danger alert-dismissible fade show" role="alert"> {{ $error }}
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
@endforeach
@endif