<!DOCTYPE html>
<html lang="en" class="no-js">

<head>
  @include('site.includes.head')
</head>

<body class="home-page home-v">
  <!-- loader image before page load starts -->
  <div class="se-pre-con"></div>
  <!-- loader image before page load ends -->
  <!-- main wrapper of the site starts -->
  <div class="wrapper">

    <!-- ============== Header starts ============== -->
    <header>
      @include('site.includes.header')
    </header>
    <!-- ============== Header ends ============== -->

    <!-- ============== Banner starts ============== -->
    <section class="banner home-banner home-banner1">
      <div class="home-slider" >

        <div id="owl-demo">

          @if($getSlider)
            @foreach ($getSlider as $key => $slide)
              <div class="item">
                <img src="{{$slide->image}}" alt="{{$slide->title}}">
                <div class="container">
                  <div class="banner-text text-left">
                    <h1 class="text-capitalize">{{$slide->title}}</h1>
                    <p>{{$slide->content}}</p>
                    <a href="{{$slide->url}}" class="btn btn-primary">learn more</a>
                  </div>
                </div>
              </div>
            @endforeach
          @endif

        </div>
      </div>
    </section>
    <!-- ============== Baner ends ============== -->

    <main>
      <!-- ============== how it works block starts ============== -->
      <section class="block how-it-works-block">
        <div class="container">
          <div class="top-text text-center wow fadeInUp">
            <h4 class="text-uppercase text-lt text-sp" >HOW IT WORKS</h4>
          </div>
          <div class="row">
            <div class="col-xs-12 col-sm-4 choose wow fadeInLeft">
              <div class="feature-item-wrap text-center">
                <figure><a href="#"><img class="img-responsive" src="images/meal.svg" alt="Meal icon" /></a></figure>
                <h5><a class="text-lt" href="#">Choose Your Favorite</a></h5>
                <p>Choose your favorite meals and order online or by phone. It's easy to customize your order.</p>
              </div>
            </div>
            <div class="col-xs-12 col-sm-4 deliver wow fadeInUp">
              <div class="feature-item-wrap text-center">
                <figure><a href="#"><img class="img-responsive" src="images/delivery.svg" alt="Delivery icon" /></a></figure>
                <h5><a class="text-lt" href="#">We Deliver Your Meals</a></h5>
                <p>We prepared and delivered meals arrive at your door. Duis autem vel eum iriure dolor in hendrerit in vulputate.</p>
              </div>
            </div>
            <div class="col-xs-12 col-sm-4 eat wow fadeInRight">
              <div class="feature-item-wrap text-center">
                <figure><a href="#"><img class="img-responsive" src="images/eat-enjoy.svg" alt="Eat and enjoy icon" /></a></figure>
                <h5><a class="text-lt" href="#">Eat and Enjoy</a></h5>
                <p>No shooping, no cooking, no counting and no cleaning. Enjoy your healthy meals with your family.</p>
              </div>
            </div>
          </div>
        </div>
      </section>
      <!-- ============== how it works block starts ============== -->


      <!-- ============== pricing block starts ============== -->
      <section class="block pricing-block" id="meal_plane">
        <div class="container">

          <div class="top-text-header text-center">
            <h4 class="wow fadeInUp text-center animated text-uppercase text-lt text-sp" style="visibility: visible; animation-name: fadeInUp;">PRICING & PLANS</h4>
          </div>

          <div class="row">

            @if($getMealPlans)
              @foreach ($getMealPlans as $key => $plan)
                <div class="col-xs-12 col-sm-4 wow fadeInLeft pricing-box">
                  <div class="text-center price-box-wrap">
                    <div class="plan-view">
                      <div class="plan-face">
                        <div class="plan-image">
                          <img src="{{$plan->cover}}" alt="">
                        </div>
                        <div class="plan-desc">
                          <h5 class="text-lt">{{$plan->name}}</h5>
                          <div class="plan-price">
                            <span class="price">{{$plan->full_day}} <small style="font-size: 14px;vertical-align: middle;">AED</small></span>
                            <span class="per-day">/day</span>
                          </div>
                        </div><a href="/meal-plans/{{$plan->slug}}" class="btn btn-primary box-btn order-now-btn test-uppercase text-sp">View plan</a>
                      </div>
                    </div>
                  </div>
                </div>
              @endforeach
            @endif

          </div>
        </div>
      </section>
      <!-- ============== pricing block ends ============== -->



      <!-- ============== blog block starts ============== -->
      <section class="blog-block">
        <div class="container">

          <div class="top-text-header text-center wow fadeInUp">
            <h4 class="text-uppercase text-lt text-sp">latest blog</h4>
          </div>

          <div class="row">
            @if($getLatestBlogs)
              @foreach ($getLatestBlogs as $key => $blog)
                <div class="col-xs-12 col-sm-4 wow fadeInLeft blog-single">
                  <div class="blog-single-wrap">
                    <figure>
                      <a href="/blog/{{$blog->slug}}">
                        <img src="/images/blog-image1.jpg" alt="Blog image" />
                      </a>
                    </figure>
                    <div class="blog-description">
                      <h6 class="text-uppercase"><a href="#" class="text-lt text-sp">{{$blog->title}}</a></h6>
                      <span class="posted-date">{{$blog->created_at}}</span>
                      <p>{!!str_limit($blog->content,150)!!}</p>
                      <a href="/blog/{{$blog->slug}}" class="text-capitalize pull-right read-more-btn text-lt text-sp">read more</a>
                    </div>
                  </div>
                </div>
              @endforeach
            @endif
          </div>
        </div>
      </section>
      <!-- ============== blog block ends ============== -->


      <!-- ============== instagram block starts ============== -->
      <section class="block instagram-block">
        <div class="container">
          <div class="top-text-header text-center">
            <h4 class="text-uppercase text-sp text-lt">FOLLOW OUR INSTAGRAM</h4>
            <span class="follow-at text-spx text-lt">@FitBite</span>
          </div>
        </div>
        <div class="instagram-image-row">
          <ul>
            <li class="wow fadeInUp"><figure><a href="#"><img src="images/instagram-img1.jpg" alt="Instagram image" /></a></figure></li>
            <li class="wow fadeInUp"><figure><a href="#"><img src="images/instagram-img2.jpg" alt="Instagram image" /></a></figure></li>
            <li class="wow fadeInUp"><figure><a href="#"><img src="images/instagram-img3.jpg" alt="Instagram image" /></a></figure></li>
            <li class="wow fadeInUp"><figure><a href="#"><img src="images/instagram-img4.jpg" alt="Instagram image" /></a></figure></li>
            <li class="wow fadeInUp"><figure><a href="#"><img src="images/instagram-img5.jpg" alt="Instagram image" /></a></figure></li>
            <li class="wow fadeInUp"><figure><a href="#"><img src="images/instagram-img6.jpg" alt="Instagram image" /></a></figure></li>
            <li class="wow fadeInUp"><figure><a href="#"><img src="images/instagram-img7.jpg" alt="Instagram image" /></a></figure></li>
          </ul>
        </div>
      </section>
      <!-- ============== instagram block starts ============== -->

      @include('site.includes.login')

    </main>
    <!-- ============== footer block starts ============== -->
    <footer>
      @include('site.includes.footer')
    </footer>
    <!-- ============== footer block starts ============== -->
  </div>
  <!-- main wrapper of the site ends -->

  @include('site.includes.foot')
  @stack('js')
</body>

</html>
