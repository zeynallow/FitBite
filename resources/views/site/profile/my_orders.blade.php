@extends('site.app')

@section('content')

  <section class="banner sample-menu-banner">
    <div class="bannerwrap">
      <figure><img src="/images/sample-menu-banner.jpg" alt="Sample menu banner" /></figure>
      <div class="banner-text text-center banner-text-page">
        <h1>My Orders</h1>
      </div>
    </div>
  </section>

  <main>
    <section style="padding:0px;" class="block">

      <div class='food-tab'>
        <div class='container'>
          <!-- Nav tabs -->
          <ul class="nav nav-tabs" role="tablist">
            <li role="presentation" class="active"><a href="/profile/my-orders">My Orders</a></li>
            <li role="presentation" class=""><a href="/profile/my-profile">My Profile</a></li>
          </ul>
        </div>
      </div>

      <div class="container">
        <table class="table">
          <thead>
            <tr>
              <td>Order ID</td>
              <td>Plan</td>
              <td>Select day</td>
              <td>Day per week</td>
              <td>Eat time</td>
              <td>Start date</td>
              <td>Amount</td>
              <td>Status</td>
              <td>Payment Status</td>
              <td>Order date</td>
            </tr>
          </thead>

          <tbody>
            @if(count($getOrders))
              @foreach ($getOrders as $key => $order)
                <tr>
                  <td>{{$order->id}}</td>
                  <td>{{($order->getPlan) ? $order->getPlan->name : ''}}</td>
                  <td>{{$order->select_day}}</td>
                  <td>{{$order->select_day_per_week}}</td>
                  <td>{{$order->select_eat_time}}</td>
                  <td>{{$order->start_date}}</td>
                  <td>{{$order->amount}}</td>
                  <td>{!!($order->status == 1) ? '<span class="label label-warning">Pending</div>' : '<span class="label label-success">Approved</span>'!!}</td>
                  <td>{!!($order->payment_status == 0) ? '<span class="label label-danger">No Paid</div>' : '<span class="label label-success">Paid</span>'!!}</td>
                  <td>{{$order->created_at}}</td>
                  <td></td>
                </tr>
              @endforeach
            @endif
          </tbody>
        </table>

        <div class="pagination">
          {{$getOrders}}
        </div>

      </section>
    </main>


  @endsection
