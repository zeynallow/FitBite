@extends('site.app')

@section('content')
  <section class="banner sample-menu-banner">
    <div class="bannerwrap">
      <figure><img src="/images/sample-menu-banner.jpg" alt="Sample menu banner" /></figure>
      <div class="banner-text text-center">
        <h1 class="text-uppercase">Meal plans</h1>
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
                  <div class="col-md-9">
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

                    <div class="col-md-3">
                      <div class="order-box">

                        <form class=""  method="post">

                          <div class="form-group">
                            <label for="week">How many days per week? </label>
                            <select class="form-control" name="">
                              <option value="">4 week</option>
                            </select>
                          </div>

                          <div class="form-group">
                            <label for="week">How many days per week? </label>
                            <select class="form-control" name="">
                              <option value="">4 week</option>
                            </select>
                          </div>

                          <div class="form-group">
                            <button type="button" name="button" class="btn btn-success">Order now</button>
                          </div>


                        </form>
                      </div>
                    </div>
                  </div>
                </div>
          <!--plan end-->
          @endforeach

          </div>
        </div>
        <!-- == Tab description ends == -->

      </section>

    </main>
  @endsection
