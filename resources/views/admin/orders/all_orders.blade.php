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
                      <td>{{$order->start_date}}</td>
                      <td>{{$order->amount}} {{$order->currency}}</td>
                      <td>
                        @if($order->status == 1)
                          <span class="btn btn-warning">Pending</span>
                        @elseif($order->status == 2)
                          <span class="btn btn-success">Approved</span>
                        @elseif($order->status == 3)
                          <span class="btn btn-danger">Declined</span>
                        @else
                          <span class="btn btn-danger">Cancelled</span>
                        @endif
                      </td>
                      <td>{!!($order->payment_status == 0) ? '<span class="btn btn-danger">No Paid</span>' : '<span class="btn btn-success">Paid</span>'!!}</td>
                      <td>{{$order->created_at}}</td>
                      <td><span data-toggle="modal" data-target="#order_{{$order->id}}" class="btn btn-info"><i class="fa fa-list"></i> More</div></td>
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
    @if(count($orders))
      @foreach ($orders as $key => $order)
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
                    <td>User</td><td><a href="/admin/user/view/{{$order->user_id}}">{{($order->getUser) ? $order->getUser->name : ''}}</a></td>
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
                    <td>Start Date</td><td>{{$order->start_date}}</td>
                  </tr>
                  <tr>
                    <td>Amount</td><td>{{$order->amount}} {{$order->currency}}</td>
                  </tr>
                  <tr>
                    <td>Status</td><td>
                      @if($order->status == 1)
                        <span class="btn btn-warning">Pending</span>
                        <span onclick="statusApprove({{$order->id}})" class="btn btn-success btn-icon-split btn-sm">
                          <span class="icon text-white-50"><i class="fa fa-check"></i></span>
                          <span class="text">Approve</span>
                        </span>
                        <span onclick="statusDecline({{$order->id}})" class="btn btn-danger btn-icon-split btn-sm">
                          <span class="icon text-white-50"><i class="fa fa-times"></i></span>
                          <span class="text">Decline</span>
                        </span>
                      @elseif($order->status == 2)
                        <span class="btn btn-success">Approved</span>
                        <span onclick="statusDecline({{$order->id}})" class="btn btn-danger btn-icon-split btn-sm">
                          <span class="icon text-white-50"><i class="fa fa-times"></i></span>
                          <span class="text">Decline</span>
                        </span>
                      @elseif($order->status == 3)
                        <span class="btn btn-danger">Declined</span>
                        <span onclick="statusApprove({{$order->id}})" class="btn btn-success btn-icon-split btn-sm">
                          <span class="icon text-white-50"><i class="fa fa-check"></i></span>
                          <span class="text">Approve</span>
                        </span>
                      @else
                        <span class="btn btn-danger">Cancelled</span>
                      @endif
                    </td>
                  </tr>
                  <tr>
                    <td>Payment status</td><td>
                      @if($order->payment_status == 0)
                        <span class="btn btn-danger">No Paid</span>
                        <span onclick="paymentPaid({{$order->id}})" class="btn btn-success btn-icon-split btn-sm">
                          <span class="icon text-white-50"><i class="fa fa-check"></i></span>
                          <span class="text">Set paid</span>
                        </span>
                      @else
                        <span class="btn btn-success">Paid</span>
                        <span onclick="paymentNoPaid({{$order->id}})" class="btn btn-success btn-icon-split btn-sm">
                          <span class="icon text-white-50"><i class="fa fa-check"></i></span>
                          <span class="text">Set No Paid</span>
                        </span>
                      @endif
                    </td>
                  </tr>
                  <tr>
                    <td>Created at</td><td>{{$order->created_at}}</td>
                  </tr>
                </table>

              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              </div>

            </div>
          </div>
        </div>
      @endforeach
    @endif

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



    function statusApprove(order_id){
      $.ajax({
        url:'/admin/orders/statusApprove/'+order_id,
        method:'GET',
        success:function(data){
          swal("Success", "Status changed!", "success");
          location.reload();
        },
        error:function(data){
          swal("Error", "Something went error...", "error");
        }
      })
    }

    function statusDecline(order_id){
      $.ajax({
        url:'/admin/orders/statusDecline/'+order_id,
        method:'GET',
        success:function(data){
          swal("Success", "Status changed!", "success");
          location.reload();
        },
        error:function(data){
          swal("Error", "Something went error...", "error");
        }
      })
    }

    function paymentPaid(order_id){
      $.ajax({
        url:'/admin/orders/paymentPaid/'+order_id,
        method:'GET',
        success:function(data){
          swal("Success", "Status changed!", "success");
          location.reload();
        },
        error:function(data){
          swal("Error", "Something went error...", "error");
        }
      })
    }

    function paymentNoPaid(order_id){
      $.ajax({
        url:'/admin/orders/paymentNoPaid/'+order_id,
        method:'GET',
        success:function(data){
          swal("Success", "Status changed!", "success");
          location.reload();
        },
        error:function(data){
          swal("Error", "Something went error...", "error");
        }
      })
    }
    </script>
  @endsection
