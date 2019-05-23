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

        <div class="row">
          <div class="col-md-6">
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
                <tr>
                  <td>Total amount</td><td>0 AED</td>
                </tr>
            </table>
          </div>
        </div>

      <form action="/confirm-order/{{$getOrder->id}}" method="post">
        @csrf
        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label for="start_date">Start date</label>
              <input type="date" class="form-control" id="start_date" name="start_date" value=""/>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <button type="submit" class="form-control btn btn-success">Confirm</button>
            </div>
          </div>

        </div>

      </form>

      </section>
    </div>
  </main>


@endsection
