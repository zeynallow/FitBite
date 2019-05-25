<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>FitBite :: Dashboard</title>

  <!-- Custom fonts for this template-->
  <link href="{{ url("/")}}/admin/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="{{ url("/")}}/admin/css/sb-admin-2.min.css" rel="stylesheet">
  <link href="{{ url("/")}}/admin/css/style.css" rel="stylesheet">
  @yield('css')
</head>

<body id="page-top">

  <!-- Page Wrapper -->
  <div id="wrapper">

    @include('admin.includes.sidebar')

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">

        <!-- Topbar -->
        <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

          <!-- Sidebar Toggle (Topbar) -->
          <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
            <i class="fa fa-bars"></i>
          </button>


          <!-- Topbar Navbar -->
          <ul class="navbar-nav ml-auto">

            <!-- Nav Item - Search Dropdown (Visible Only XS) -->
            <li class="nav-item dropdown no-arrow d-sm-none">
              <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-search fa-fw"></i>
              </a>
              <!-- Dropdown - Messages -->
              <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in" aria-labelledby="searchDropdown">
                <form class="form-inline mr-auto w-100 navbar-search">
                  <div class="input-group">
                    <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
                    <div class="input-group-append">
                      <button class="btn btn-primary" type="button">
                        <i class="fas fa-search fa-sm"></i>
                      </button>
                    </div>
                  </div>
                </form>
              </div>
            </li>

            <!-- Nav Item - Alerts -->
            {{-- <li class="nav-item dropdown no-arrow mx-1 dropdown-notifications">
              <a class="nav-link dropdown-toggle" href="#notifications-panel" id="alertsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-bell fa-fw"></i>
                <!-- Counter - Alerts -->
                <span class="badge badge-danger badge-counter"><span data-count="0">0</span></span>
              </a>
              <!-- Dropdown - Alerts -->
              <div class="dropdown-notifications dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="alertsDropdown">
                <h6 class="dropdown-header">
                  Notifications (<span class="notif-count">0</span>)
                </h6>

                <div class="dropdown-menu">
                </div>

                <a class="dropdown-item text-center small text-gray-500" href="#">Show All Alerts</a>
              </div>
            </li> --}}



            <div class="topbar-divider d-none d-sm-block"></div>

            <!-- Nav Item - User Information -->
            <li class="nav-item dropdown no-arrow">
              <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="mr-2 d-none d-lg-inline text-gray-600 small">{{Auth::user()->name}}</span>
                <img class="img-profile rounded-circle" src="https://source.unsplash.com/QAB-WJcbgJk/60x60">
              </a>
              <!-- Dropdown - User Information -->
              <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                <a class="dropdown-item" href="#">
                  <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                  Profile
                </a>
                <a class="dropdown-item" href="#">
                  <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                  Settings
                </a>
                <a class="dropdown-item" href="#">
                  <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
                  Activity Log
                </a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="{{url('/admin/logout')}}">
                  <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                  Logout
                </a>
              </div>
            </li>

          </ul>

        </nav>
        <!-- End of Topbar -->

        <!-- Begin Page Content -->
        <div class="container-fluid">

          @yield('content')

        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->

      <!-- Footer -->
      <footer class="sticky-footer bg-white">
        <div class="container my-auto">
          <div class="copyright text-center my-auto">
            <span>Copyright &copy; FitBite.ae</span>
          </div>
        </div>
      </footer>
      <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->

  </div>
  <!-- End of Page Wrapper -->

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>


  <!-- Bootstrap core JavaScript-->
  <script src="{{ url("/")}}/admin/vendor/jquery/jquery.min.js"></script>
  <script src="{{ url("/")}}/admin/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="{{ url("/")}}/admin/vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="{{ url("/")}}/admin/js/sb-admin-2.min.js"></script>
  @yield('js')

  <script src="//js.pusher.com/3.1/pusher.min.js"></script>
  <script type="text/javascript">
  //
  // var notificationsWrapper   = $('.dropdown-notifications');
  // var notificationsToggle    = notificationsWrapper.find('a[data-toggle]');
  // var notificationsCountElem = notificationsToggle.find('i[data-count]');
  // var notificationsCount     = parseInt(notificationsCountElem.data('count'));
  // var notifications          = notificationsWrapper.find('div.dropdown-menu');
  //
  // if (notificationsCount <= 0) {
  //   notificationsWrapper.hide();
  // }
  //
  // // Enable pusher logging - don't include this in production
  //  Pusher.logToConsole = true;
  //
  // var pusher = new Pusher('341df767944aba721a70', {
  //   encrypted: true,
  //   cluster: 'ap2'
  // });
  //
  // var channel = pusher.subscribe('new-order');
  //
  // channel.bind('\\App\\Events\\NewOrder', function(data) {
  //     console.log(data);
  // });
  //
  // channel.bind('App\\Events\\NewOrder', function(data) {
  //   console.log(data);
  //   var existingNotifications = notifications.html();
  //   var newNotificationHtml = `
  //     <a class="dropdown-item d-flex align-items-center" href="#">
  //       <div class="mr-3">
  //         <div class="icon-circle bg-success">
  //           <i class="fas fa-donate text-white"></i>
  //         </div>
  //       </div>
  //       <div>
  //         <div class="small text-gray-500">December 7, 2019</div>
  //         `+data.message+`
  //       </div>
  //     </a>
  //   `;
  //   notifications.html(newNotificationHtml + existingNotifications);
  //
  //   notificationsCount += 1;
  //   notificationsCountElem.attr('data-count', notificationsCount);
  //   notificationsWrapper.find('.notif-count').text(notificationsCount);
  //   notificationsWrapper.show();
  // });
  </script>
</body>

</html>
