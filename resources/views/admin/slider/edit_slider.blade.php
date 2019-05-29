@extends('admin.app')

@section('content')


  <!-- Page Heading -->
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Sliders</h1>
  </div>

  <!-- Content Row -->
  <div class="row">

    <div class="col-md-12">
      <div class="card shadow mb-4">
        <div class="card-header py-3">
          <h6 class="m-0 font-weight-bold text-primary">Update slide</h6>
        </div>
        <div class="card-body">

          <form class="" action="{{url('/admin/slider/update').'/'.$slide->id}}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                  <label for="title">Title</label>
                  <input type="text" name="title" id="title" value="{{$slide->title}}" class="form-control">
                  @if(!empty($errors->get('title')))
                    <ul class="alert-danger">
                      @foreach ($errors->get('title') as $error)
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
                  <label for="content">Content</label>
                  <input type="text" name="content" id="content" value="{{$slide->content}}" class="form-control">
                  @if(!empty($errors->get('content')))
                    <ul class="alert-danger">
                      @foreach ($errors->get('content') as $error)
                        <li>{{ $error }}</li>
                      @endforeach
                    </ul>
                  @endif
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-md-4">
                @if($slide->image)
                  <img src="{{$slide->image}}" width="100%" alt="">
                @endif
              </div>
              <div class="col-md-8">
                <div class="form-group">
                  <label for="content">Image</label>
                  <input type="file" name="image" id="image" class="form-control">
                  @if(!empty($errors->get('image')))
                    <ul class="alert-danger">
                      @foreach ($errors->get('image') as $error)
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
                  <label for="content">Sort</label>
                  <input type="text" name="sort" id="sort" value="{{$slide->sort}}" class="form-control">
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                  <label for="content">URL</label>
                  <input type="text" name="url" id="url" value="{{$slide->url}}" class="form-control">
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                  <label for="content">Status</label>
                  <select name="status" id="status" class="form-control">
                    @if($slide->status == 1)
                      <option value="1">Publish</option>
                      <option value="2">Unpublish</option>
                    @else
                      <option value="2">Unpublish</option>
                      <option value="1">Publish</option>
                    @endif
                  </select>
                </div>
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


@endsection
