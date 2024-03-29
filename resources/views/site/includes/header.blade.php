
<div class="container">
  <div class="row">

    <!-- ============== Left logo block starts ============== -->
    <div class="col-xs-12 col-sm-2 logo-block">
      <figure><a href="/"><img class="img-responsive" width="100" src="/img/logo.png" alt="Logo" /></a></figure>
    </div>
    <!-- ============== Left logo block ends ============== -->

    <!-- ============== Main navigation starts ============== -->
    <div class="col-xs-12 col-sm-8 menu-block">
      <nav class="navbar navbar-default">
        <div class="container-fluid">
          <!-- Brand and toggle get grouped for better mobile display -->
          <div class="navbar-header">
            <button type="button" class="navbar-toggle">
              <span class="sr-only">Toggle navigation</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
          </div>

          <!-- Collect the nav links, forms, and other content for toggling -->
          <div class="collapse">
            <ul class="nav navbar-nav text-right pull-right" style="top: 10px;position: relative;">
              <li class="active"><a href="/page/about-us">About Us</a></li>
              <li><a href="/page/how-it-works">How it works</a></li>
              <li><a href="/meal-plans">Pricing & Plans</a></li>
              <li><a href="/page/faqs">FAQ's</a></li>
              <li><a href="/blogs">Blog</a></li>
            </ul>
          </div><!-- /.navbar-collapse -->
        </div><!-- /.container-fluid -->
      </nav>
    </div>

    <div class="col-xs-12 col-sm-2 nav-right-btn">
      @if (Auth::guest())
        <a class="btn border-btn-small" href="#" data-toggle="modal" data-target="#loginModal"  style="top: 10px;position: relative;"><i class="fa fa-user"></i> login</a>
      @else
        <a class="btn border-btn-small" href="/profile" style="top: 10px;position: relative;"><i class="fa fa-user"></i> {{Auth::user()->name}}</a>
        <a class="" href="/profile/logout" style="top: 10px;position: relative;"><i class="fa fa-sign-out"></i></a>
      @endif

    </div>
    <!-- ============== Main navigation ends ============== -->

  </div>
</div>
