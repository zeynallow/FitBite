@php
use Carbon\Carbon;
@endphp

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
              <td>Start date</td>
              <td>Amount</td>
              <td>Status</td>
              <td>Payment Status</td>
              <td></td>
            </tr>
          </thead>

          <tbody>
            @if(count($getOrders))
              @foreach ($getOrders as $key => $order)
                <tr>
                  <td>{{$order->id}}</td>
                  <td>{{($order->getPlan) ? $order->getPlan->name : ''}}</td>
                  <td>
                    @php
                    $carbonated_date = Carbon::parse($order->start_date);
                    $start_date = $carbonated_date->diffForHumans(Carbon::now());
                    echo $start_date;
                    @endphp
                  </td>
                  <td>{{$order->amount}} {{$order->currency}}</td>
                  <td>
                    @if($order->status == 1)
                      <span class="label label-warning">Pending</span>
                    @elseif($order->status == 2)
                      <span class="label label-success">Approved</span>
                    @elseif($order->status == 3)
                      <span class="label label-danger">Decline</span>
                    @else
                      <span class="label label-danger">Cancelled</span>
                    @endif
                    <td>{!!($order->payment_status == 0) ? '<span class="label label-warning">No Paid</div>' : '<span class="label label-success">Paid</span>'!!}</td>
                    <td>
                      <button type="button" data-toggle="modal" data-target="#order_{{$order->id}}" class="label label-info">
                        <i class="fa fa-list"></i> More
                      </button>
                    </td>
                  </tr>
                @endforeach
              @else
                <tr>
                  <td colspan="7">
                    <div class="alert alert-info">
                      No orders
                    </div>
                  </td>
                </tr>
              @endif
            </tbody>
          </table>

          <div class="pagination">
            {{$getOrders}}
          </div>

        </section>
      </main>


      @if(count($getOrders))
        @foreach ($getOrders as $key => $order)
          <div class="modal fade" id="order_{{$order->id}}" tabindex="-1" role="dialog" aria-labelledby="order_{{$order->id}}_title" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="order_{{$order->id}}_title">Modal title</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  <table class="table">
                    <tr>
                      <td>Order ID</td><td>{{$order->id}}</td>
                    </tr>
                    <tr>
                      <td>Plan</td><td>{{($order->getPlan) ? $order->getPlan->name : ''}}</td>
                    </tr>
                    <tr>
                      <td>Select day</td><td>{{$order->getData('select_day',$order->select_day)}}</td>
                    </tr>
                    <tr>
                      <td>Day per week</td><td>{{$order->getData('select_day_per_week',$order->select_day_per_week)}}</td>
                    </tr>
                    <tr>
                      <td>Eat time</td><td>{{$order->getData('select_eat_time',$order->select_eat_time)}}</td>
                    </tr>
                    <tr>
                      <td>Start Date</td><td>
                        @php
                        $carbonated_date = Carbon::parse($order->start_date);
                        $start_date = $carbonated_date->diffForHumans(Carbon::now());
                        echo $start_date;
                        @endphp
                      </td>
                    </tr>
                    <tr>
                      <td>Amount</td><td>{{$order->amount}} {{$order->currency}}</td>
                    </tr>
                    <tr>
                      <td>Status</td><td>
                        @if($order->status == 1)
                          <span class="label label-warning">Pending</span>
                        @elseif($order->status == 2)
                          <span class="label label-success">Approved</span>
                        @else
                          <span class="label label-danger">Cancelled</span>
                        @endif
                      </td>
                    </tr>
                    <tr>
                      <td>Payment status</td><td>{!!($order->payment_status == 0) ? '<span class="label label-warning">No Paid</span>' : '<span class="label label-success">Paid</span>'!!}
                      </td>
                    </tr>
                    <tr>
                      <td>Created at</td><td>{{$order->created_at->diffForHumans()}}</td>
                    </tr>
                  </table>

                </div>
                <div class="modal-footer">

                  @if($order->status == 1 || $order->status == 2)
                    <a href="/cancel-order/{{$order->id}}" class="btn btn-danger pull-left"><i class="fa fa-times"></i> Cancel Plan</a>
                  @endif

                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>

              </div>
            </div>
          </div>
        @endforeach
      @endif

    @endsection
