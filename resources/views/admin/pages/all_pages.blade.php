@extends('admin.app')
@section('css')
  <link href="{{ asset('admin/css/sweet-alert.css') }}" rel="stylesheet">
@endsection
@section('content')


  <!-- Page Heading -->
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Pages</h1>
    <a href="{{url('/admin/page/add')}}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
      <i class="fas fa-plus fa-sm text-white-50"></i> Create new page
    </a>
  </div>

  <!-- Content Row -->
  <div class="row">

    <div class="col-md-12">


      <div class="card shadow mb-4">
        <div class="card-header py-3">
          <h6 class="m-0 font-weight-bold text-primary">All pages</h6>
        </div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table " id="dataTable" width="100%" cellspacing="0">
              <thead>
                <tr>
                  <th>ID</th>
                  <th>Title</th>
                  <th>Slug</th>
                  <th colspan="3"></th>
                </tr>
              </thead>

              <tbody>
                <tr>
                  @if($pages)
                    @foreach($pages as $page)
                      <tr>
                        <td>{{$page->id}}</td>
                        <td>{{$page->title}}</td>
                        <td>{{$page->slug}}</td>
                        <td width="5%">
                          <a class="btn btn-success" target="_blank" href="{{url('/page').'/'.$page->slug}}"><i class="fa fa-eye"></i></a>
                        </td>
                        <td width="5%">
                          <a class="btn btn-primary" href="{{url('/admin/page/edit').'/'.$page->id}}"><i class="far fa-edit"></i></i></a>
                        </td>
                        <td width="5%">
                          <form  id='data-item-form{{$page->id}}' action="{{ url('/admin/delete/page').'/'.$page->id }}" method="post">
                            @csrf
                              <a class="btn btn-danger" href="javascript:void(0)" onclick="removeItem({{ $page->id }})"><i class="fa fa-trash"></i></a>

                          </form>
                        </td>
                      </tr>
                    @endforeach
                  @endif
                </tr>
              </tbody>
            </table>
          </div>

          <div class="row justify-content-center">
              {{$pages}}
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
