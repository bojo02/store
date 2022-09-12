@extends("base")

@section("body")
<h2>Статус на поръчка<span class="badge badge-secondary">{{$order->status->name}}</span></h2>

<table class="table">
<thead class="thead-dark">
    <tr>
      <th scope="col">Продукт</th>
      <th scope="col">Количество</th>
      <th scope="col">Цена</th>
    </tr>
  </thead>
  <tbody>
      @foreach ($order_items as $item)
        <tr>
            <th scope="row">{{$item->product->title}}</th>
            <th scope="row">{{$item->quanity}}</th>
            <th scope="row">{{$item->price}}</th>
        </tr>
      @endforeach
  </tbody>
</table>

<div style="text-align:center;">
    <h3>Крайна цена: {{$order->total}}</h3>

    <p> Платежен метод: {{$order->payment->name}}</p>

    <p>Град: {{$order->city}}</p>

    <p>Държава: {{$order->country}}</p>

    <p>Адрес за доставка: {{$order->address}}</p>

    <p>Име и фамилия: {{$order->user->name}}</p>

    <p>Имейл: {{$order->user->email}}</p>

    <form action="{{route('order.destroy', ['order' => $order->id])}}" method="POST">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger btn-lg btn-block">Изтрий</button>
    </form>

</div>

@endsection