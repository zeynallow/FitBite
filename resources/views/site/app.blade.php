<!DOCTYPE html>
<html lang="en">

<head>
  @include('site.includes.head')
</head>

<body class="sample-menu-page">

  <div class="se-pre-con"></div>

  <div class="wrapper">

    <header>
      @include('site.includes.header')
    </header>

    @yield('content')


    <footer>
      @include('site.includes.footer')
    </footer>


  </div>

  @include('site.includes.foot')

  @stack('js')
  
</body>

</html>
