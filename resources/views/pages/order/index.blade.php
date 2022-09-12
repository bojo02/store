@extends("base")

@section("body")
<table class="table">
<thead class="thead-dark">
    <tr>
      <th scope="col">Номер на поръчка</th>
      <th scope="col">Име</th>
      <th scope="col">Имейл</th>
      <th scope="col">Стойност</th>
      <th scope="col">Статус</th>
      <th scope="col">Отвори</th>
    </tr>
  </thead>
  <tbody>
      @foreach ($orders as $order)
        <tr>
            <th scope="row">{{$order->id}}</th>
            <td>{{$order->user->name}}</td>
            <td>{{$order->user->email}}</td>
            <td>{{$order->total}}{{__('shop.leva')}}</td>
            <td>{{$order->status->name}}</td>
            <td><a href="{{route('order.show', ['order' => $order->id])}}">Отвори</a></td>
        </tr>
      @endforeach
  </tbody>
</table>
@endsection