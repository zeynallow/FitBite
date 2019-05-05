@extends('admin.app')
@section('content')


  <!-- Page Heading -->
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Blogs</h1>
  </div>

  <!-- Content Row -->
  <div class="row">

    <div class="col-md-12">
      <div class="card shadow mb-4">
        <div class="card-header py-3">
          <h6 class="m-0 font-weight-bold text-primary">Update blog</h6>
        </div>
        <div class="card-body">

          <form class="" action="{{url('/admin/blog/update').'/'.$blog->id}}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                  <label for="title">Blog title</label>
                  <input type="text" name="title" id="title" class="form-control" value="{{$blog->title}}">
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
                  <label for="slug">Slug</label>
                  <input type="text" name="slug" id="slug" class="form-control" value="{{$blog->slug}}">
                  @if(!empty($errors->get('slug')))
                    <ul class="alert-danger">
                      @foreach ($errors->get('slug') as $error)
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
                  <textarea name="content" id="editor1" rows="8" cols="80" class="form-control">{!! $blog->content !!}</textarea>
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
@section('js')
    <script src="{{ asset('admin/ckeditor/ckeditor.js') }}"></script>
    <script src="{{ asset('admin/js/slugify.js') }}"></script>
    <script>
        CKEDITOR.replace( 'editor1' );
    </script>
    <script>
        var post_name = $("#title");
        var post_slug_d = $("#slug");
        post_name.keyup(function () {
            str = post_name.val();
            post_slug_d.val(url_slug(str));

        });

    </script>

@endsection
