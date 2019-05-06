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

            <br>
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


@endsection
