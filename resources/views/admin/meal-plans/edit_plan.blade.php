@extends('admin.app')
@section('content')


  <!-- Page Heading -->
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Meal plans</h1>
  </div>

  <!-- Content Row -->
  <div class="row">

    <div class="col-md-12">
      <div class="card shadow mb-4">
        <div class="card-header py-3">
          <h6 class="m-0 font-weight-bold text-primary">Update plan</h6>
        </div>
        <div class="card-body">

          <form class="" action="{{url('/admin/meal-plan/update').'/'.$plan->id}}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                  <label for="name">Plan name</label>
                  <input type="text" name="name" id="name" class="form-control" value="{{$plan->name}}">
                  @if(!empty($errors->get('name')))
                    <ul class="alert-danger">
                      @foreach ($errors->get('name') as $error)
                        <li>{{ $error }}</li>
                      @endforeach
                    </ul>
                  @endif
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                  <label for="full_day">Full day price</label>
                  <input type="text" name="full_day" id="full_day" class="form-control" value="{{$plan->full_day}}">
                  @if(!empty($errors->get('full_day')))
                    <ul class="alert-danger">
                      @foreach ($errors->get('full_day') as $error)
                        <li>{{ $error }}</li>
                      @endforeach
                    </ul>
                  @endif
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                  <label for="half_day">Half day price</label>
                  <input type="text" name="half_day" id="half_day" class="form-control" value="{{$plan->half_day}}">
                  @if(!empty($errors->get('half_day')))
                    <ul class="alert-danger">
                      @foreach ($errors->get('half_day') as $error)
                        <li>{{ $error }}</li>
                      @endforeach
                    </ul>
                  @endif
                </div>
              </div>
            </div>


            <div class="row">
              <div class="col-md-8">
                <div class="form-group">
                  <label for="content">Cover image</label>
                  <input type="file" name="cover" class="form-control" value="">
                  @if(!empty($errors->get('cover')))
                    <ul class="alert-danger">
                      @foreach ($errors->get('cover') as $error)
                        <li>{{ $error }}</li>
                      @endforeach
                    </ul>
                  @endif
                </div>
              </div>
              <div class="col-md-4">
                @if($plan->cover != NULL)
                  <img height="100" src="{{$plan->cover}}" alt="">
                @endif
              </div>
            </div>

            <br/>

            <div class="card shadow mb-2">
              <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">
                  Includes <button data-toggle="modal" data-target="#addInclude" type="button" class="btn btn-success" style="float: right;" name="button">+ Add include</button>
                </h6>
              </div>
              <div class="card-body">

                <table class="table" id="includesTable">
                  <thead>
                    <tr>
                      <td>Cover</td>
                      <td>Name</td>
                      <td>Includes</td>
                      <td></td>
                    </tr>
                  </thead>
                  <tbody>
                    @if(count($plan->getIncludes))
                      @foreach ($plan->getIncludes as $key => $include)
                        <tr id="inc_{{$include->id}}">
                          <td><img width="60" src="{{$include->cover}}"/></td>
                          <td>{{$include->name}}</td>
                          <td>{{$include->includes}}</td>
                          <td><button onclick="deleteInclude({{$include->id}})" type="button" class="btn btn-danger"><i class="fa fa-times"></i></button></td>
                        </tr>
                      @endforeach
                    @endif
                  </tbody>
                </table>

              </div>
            </div>

            <br/>

            <div class="row justify-content-center">
              <div class="col-md-4">
                <div class="form-group">
                  <button type="submit" class="btn btn-primary form-control">Update</button>
                </div>
              </div>
            </div>


          </form>

        </div>
      </div>

    </div>
  </div>


  <!-- Modal -->
  <div class="modal fade" id="addInclude" tabindex="-1" role="dialog" aria-labelledby="addIncludeLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">

        <form id="addIncludeForm" method="post" enctype="multipart/form-data">
          <div class="modal-header">
            <h5 class="modal-title" id="addIncludeLabel">Add include</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="form-group">
              <label for="name">Name *</label>
              <input type="text" name="name" id="inc_name" class="form-control" value="">
            </div>

            <div class="form-group">
              <label for="includes">Includes *</label>
              <input type="text" name="includes" id="inc_includes" class="form-control" value="">
            </div>

            <div class="form-group">
              <label for="cover">Image</label>
              <input type="file" name="cover" id="cover" class="form-control" value="">
            </div>
          </div>
          <input type="hidden" name="plan_id" value="{{$plan->id}}"/>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Confirm</button>
          </div>
        </form>

      </div>
    </div>
  </div>

@endsection

@section('js')
  <script type="text/javascript">


  $("#addIncludeForm").submit(function(event){

    event.preventDefault();

    var data = new FormData(this);

    $.ajax({
      url:'/admin/meal-plan/add-include',
      data:data,
      enctype: 'multipart/form-data',
      processData: false,
      contentType: false,
      method:'POST',
      success:function(response){
        $("#addInclude").modal('toggle'); //hide modal;

        $("#includesTable tbody").append('<tr id="inc_'+ response.id +'">\
        <td><img width="60" src="'+ response.cover +'"/></td>\
        <td>'+ response.name +'</td>\
        <td>'+ response.includes +'</td>\
        <td><button type="button" onclick="deleteInclude('+ response.id +')" class="btn btn-danger"><i class="fa fa-times"></i></button></td>\
        </tr>');
      },
      error:function(response){
        alert('Something went error...');
      }
    });
    return false;
  });


  function deleteInclude(id){

    var r = confirm("Delete?");

    if (r == true) {
      $.ajax({
        url:'/admin/meal-plan/delete-include',
        data:{id:id},
        method:'GET',
        success:function(response){
          $("#inc_"+id).fadeOut();
        },
        error:function(response){
          alert('Something went error...');
        }
      });
    }


  }

  </script>
@endsection
