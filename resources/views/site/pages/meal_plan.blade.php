@extends('site.app')

@section('content')
  <section class="banner sample-menu-banner">
    <div class="bannerwrap">
      <figure><img src="/images/sample-menu-banner.jpg" alt="Sample menu banner" /></figure>
      <div class="banner-text text-center banner-text-page">
        <h1>Meal plans</h1>
      </div>
    </div>
  </section>


  <main>

    <section style="padding:0px;" class="block">

      <!-- == menu tab part starts == -->
      <div class='food-tab wow fadeInUp'>
        <div class='container'>
          <!-- Nav tabs -->
          <ul class="nav nav-tabs" role="tablist">
            @foreach ($getMealPlans as $key => $plan)
              <li role="presentation" class="{{($key == 0) ? 'active' : ''}}"><a href="#plan_{{$plan->id}}" role="tab" data-toggle="tab">{{$plan->name}}</a></li>
            @endforeach
          </ul>
        </div>
      </div>
      <!-- == menu tab part ends == -->

      <!-- == Tab description starts == -->
      <div class='tab-description'>
        <div class="container">
          <div class="tab-content">

            @foreach ($getMealPlans as $key => $plan)
              <!--plan start-->
              <div role="tabpanel" class="tab-pane fade {{($key == 0) ? 'in active' : ''}}" id="plan_{{$plan->id}}">
                <div class="row">
                  <div class="col-md-8">
                    <!-- == food listing group starts == -->
                    <div class="food-listing-group">
                      @if($plan->getIncludes)
                        @foreach ($plan->getIncludes as $key => $includes)

                          <div class="food-listing-row wow fadeInLeft">
                            <div class="food-image">
                              <a href='#'><figure><img class="img-responsive" src="{{$includes->cover}}" alt="Food image" /></figure></a>
                            </div>
                            <div class="food-type">
                              <h5><a href="#">{{$includes->name}}</a></h5>
                            </div>
                            <div class="food-ingredients">
                              {{$includes->includes}}
                            </div>
                            <div class="">
                            </div>
                          </div>

                        @endforeach
                      @endif

                      <!-- == food listing group ends == -->
                    </div>
                  </div>

                  <div class="col-md-4">
                    <div class="order-box">

                      <form class="" action="/meal-plans/{{$plan->id}}/order" method="post">
                        <div class="form-group">
                          <label for="week">How long do you want to maintain your healthy lifestyle?</label>
                          <select class="form-control" name="select_day" id="select_day_{{$plan->id}}">
                            <option value="1">1 day</option>
                            <option value="2">1 week</option>
                            <option value="3">4 weeks</option>
                          </select>
                        </div>
                        <div class="form-group" id="day_per_week_{{$plan->id}}" style="display:none;">
                          <label for="week">How many days per week? </label>
                          <select class="form-control" name="select_day_per_week" id="select_day_per_week_{{$plan->id}}">
                            <option value="5">5 days per week</option>
                            <option value="6">6 days per week</option>
                            <option value="7">7 days per week</option>
                          </select>
                        </div>

                        <div class="form-group">
                          <label for="week">Select eat time</label>
                          <select class="form-control" name="select_eat_time" id="select_eat_time_{{$plan->id}}">
                            <option value="1" data-price="{{$plan->full_day}}">Breakfast-Lunch-Dinner</option>
                          </select>
                        </div>
                        @csrf
                        <h3>Total: <span id="total_price_{{$plan->id}}">{{$plan->full_day}}</span> AED</h3>
                        <div class="form-group">

                          @if (Auth::guest())
                            <button type="button" data-toggle="modal" data-target="#loginModal" name="button" class="form-control btn btn-success">Order now</button>
                          @else

                            <button type="submit" name="button" class="form-control btn btn-success">Order now</button>
                          @endif

                        </div>
                      </form>

                    </div>
                  </div>
                </div>
              </div>
              <!--plan end-->

              @push('js')
                <script type="text/javascript">

                $("#select_day_{{$plan->id}}").change(function(){
                  var select_day = $(this).val();
                  if(select_day == 1){
                    $("#day_per_week_{{$plan->id}}").hide();
                    $("#select_eat_time_{{$plan->id}}").empty().append('<option value="1" data-price="{{$plan->full_day}}">Breakfast-Lunch-Dinner</option>');
                  }else{
                    $("#day_per_week_{{$plan->id}}").show();
                    $("#select_eat_time_{{$plan->id}}").empty().append('<option value="1" data-price="{{$plan->full_day}}">Breakfast-Lunch-Dinner</option>');
                    $("#select_eat_time_{{$plan->id}}").append('<option value="2" data-price="{{$plan->half_day}}">Breakfast-Lunch</option>');
                    $("#select_eat_time_{{$plan->id}}").append('<option value="3" data-price="{{$plan->half_day}}">Lunch-Dinner</option>');
                    $("#select_eat_time_{{$plan->id}}").append('<option value="4" data-price="{{$plan->half_day}}">Breakfast-Dinner</option>');
                  }
                  var select_day_per_week = $("#select_day_per_week_{{$plan->id}}").val();
                  var price_eat_time = $("#select_eat_time_{{$plan->id}}").find(':selected').data('price');
                  var total_price = calcPlan(select_day,select_day_per_week,price_eat_time);
                  $("#total_price_{{$plan->id}}").html(total_price);
                });


                $("#select_day_per_week_{{$plan->id}}").change(function(){
                  var select_day = $("#select_day_{{$plan->id}}").val();
                  var select_day_per_week = $("#select_day_per_week_{{$plan->id}}").val();
                  var price_eat_time = $("#select_eat_time_{{$plan->id}}").find(':selected').data('price');
                  var total_price = calcPlan(select_day,select_day_per_week,price_eat_time);
                  $("#total_price_{{$plan->id}}").html(total_price);
                });

                $("#select_eat_time_{{$plan->id}}").change(function(){
                  var select_day = $("#select_day_{{$plan->id}}").val();
                  var select_day_per_week = $("#select_day_per_week_{{$plan->id}}").val();
                  var price_eat_time = $("#select_eat_time_{{$plan->id}}").find(':selected').data('price');
                  var total_price = calcPlan(select_day,select_day_per_week,price_eat_time);
                  $("#total_price_{{$plan->id}}").html(total_price);
                });


                function calcPlan(select_day,select_day_per_week,price_eat_time){
                  if(select_day == 1){ //1 day
                    var total_price = price_eat_time;
                  }else if(select_day == 2){ //1 week
                    var total_price = parseFloat(select_day_per_week)*parseFloat(price_eat_time);
                  }else{
                    var total_price = parseFloat(select_day_per_week)*parseFloat(4)*parseFloat(price_eat_time);
                  }
                  return total_price;
                }

                </script>
              @endpush


            @endforeach

          </div>
        </div>
        <!-- == Tab description ends == -->

      </section>

    </main>
  @endsection
