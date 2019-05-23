@extends('admin.app')
@section('css')
  <link href="{{ asset('admin/css/sweet-alert.css') }}" rel="stylesheet">
@endsection
@section('content')


  <!-- Page Heading -->
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Orders</h1>
  </div>

  <!-- Content Row -->
  <div class="row">

    <div class="col-md-12">


      <div class="card shadow mb-4">
        <div class="card-header py-3">
          <h6 class="m-0 font-weight-bold text-primary">All orders</h6>
        </div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table " id="dataTable" width="100%" cellspacing="0">
              <thead>
                <tr>
                  <td>Order ID</td>
                  <td>User</td>
                  <td>Plan</td>
                  <td>Select day</td>
                  <td>Day per week</td>
                  <td>Eat time</td>
                  <td>Start date</td>
                  <td>Amount</td>
                  <td>Status</td>
                  <td>Payment Status</td>
                  <td>Order date</td>
                  <td></td>
                </tr>
              </thead>

              <tbody>
                @if(count($orders))
                  @foreach ($orders as $key => $order)
                    <tr>
                      <td>{{$order->id}}</td>
                      <td><a href="/admin/user/view/{{$order->user_id}}">{{($order->getUser) ? $order->getUser->name : ''}}</a></td>
                      <td>{{($order->getPlan) ? $order->getPlan->name : ''}}</td>
                      <td>{{$order->select_day}}</td>
                      <td>{{$order->select_day_per_week}}</td>
                      <td>{{$order->select_eat_time}}</td>
                      <td>{{$order->start_date}}</td>
                      <td>{{$order->amount}}</td>
                      <td>{!!($order->status == 1) ? '<span class="btn btn-warning">Pending</div>' : '<span class="btn btn-success">Approved</span>'!!}</td>
                      <td>{!!($order->payment_status == 0) ? '<span class="btn btn-danger">No Paid</div>' : '<span class="btn btn-success">Paid</span>'!!}</td>
                      <td>{{$order->created_at}}</td>
                      <td></td>
                    </tr>
                  @endforeach
                @endif
              </tbody>
            </table>
          </div>

          <div class="row justify-content-center">
              {{$orders}}
          </div>
        </div>
      </div>




    </div>

  </div>


@endsection
@section('js')
  <script src="{{ asset('admin/js/sweet-alert.js') }}"></script>

  <script>

  function removeItem($id) {

    swal({
      title: "Are you sure",
      text: "You will be able to recover this data!",
      type: "warning",
      showCancelButton: true,
      confirmButtonColor: "#DD6B55",
      confirmButtonText: "Yes, sure",
      cancelButtonText: "No, cancel",
      closeOnConfirm: false,
      closeOnCancel: false
    },
    function (isConfirm) {
      if (isConfirm) {
        $('#data-item-form' + $id).submit();
      } else {
        swal("Cancelled", "You have cancelled", "error");
      }
    });
  }
  </script>
@endsection
