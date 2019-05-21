@extends('site.app')

@section('content')

  <section class="banner sample-menu-banner">
    <div class="bannerwrap">
      <figure><img src="/images/sample-menu-banner.jpg" alt="Sample menu banner" /></figure>
      <div class="banner-text text-center banner-text-page">
        <h1>Order Meal Plan</h1>
      </div>
    </div>
  </section>

  <main>
    <section class="block">
      <div class="container">
        <div class="alert alert-info">
             Please confirm your order
        </div>

        <table class="table">
            <tr>
              <td>Plan</td><td>{{($getOrder->getPlan) ? $getOrder->getPlan->name : ''}}</td>
            </tr>
            <tr>
              <td>How long do you want to maintain your healthy lifestyle?</td><td>{{$getOrder->select_day}}</td>
            </tr>
            <tr>
              <td>How many days per week?</td><td>{{$getOrder->select_day_per_week}}</td>
            </tr>
            <tr>
              <td>Eat time</td><td>{{$getOrder->select_eat_time}}</td>
            </tr>

        </table>

      </section>
    </div>
  </main>


@endsection
