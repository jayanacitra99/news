@extends('admin/template')
@section('title')
    Edit Post
@endsection
@section('script-head')
<!-- summernote -->
<link rel="stylesheet" href="{{asset('')}}adminlte/plugins/summernote/summernote-bs4.min.css">
<!-- Select2 -->
<link rel="stylesheet" href="{{asset('')}}adminlte/plugins/select2/css/select2.min.css">
<link rel="stylesheet" href="{{asset('')}}adminlte/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
<!-- Tempusdominus Bootstrap 4 -->
<link rel="stylesheet" href="{{asset('')}}adminlte/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
<!-- Theme style -->
<link rel="stylesheet" href="{{asset('')}}adminlte/dist/css/adminlte.min.css">
@endsection
@section('content')
<div class="row">
    <div class="col-md-12">
      <div class="card card-outline card-info">
        <!-- /.card-header -->
        <div class="card-body">
            <form action="{{url('editThisPost/'.$news->id)}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="form-group col-3">
                        <label for="title">Title</label>
                        <input type="text" name="title" class="form-control" id="title" placeholder="Enter Title" value="{{$news->title}}">
                    </div>
                    @error('title')
                        <div class="alert alert-danger" id="notif" swalType="error" swalTitle="{{$message}}" style="display: none">{{session('notif')}}</div>
                        <script> window.addEventListener("load",clickNotif);</script>	
                    @enderror
                    <div class="form-group col-3">
                        <label for="category">Category</label>
                        <select class="select2" multiple="multiple" name="category[]" id="category" data-placeholder="Select a Category" style="width: 100%;">
                            @foreach ($category as $cat)
                                <?php $found = false;?>
                                @foreach (unserialize($news->category) as $unCat)
                                    @if ($cat->category == $unCat)
                                        <?php $found = true;?>
                                    @endif
                                @endforeach
                                <option value="{{$cat->category}}" {{$found === true ? 'selected':''}}>{{$cat->category}}</option> 
                            @endforeach
                        </select>
                    </div>
                    @error('category')
                        <div class="alert alert-danger" id="notif" swalType="error" swalTitle="{{$message}}" style="display: none">{{session('notif')}}</div>
                        <script> window.addEventListener("load",clickNotif);</script>	
                    @enderror
                    <div class="form-group col-1">
                        <img src="{{asset($news->image)}}" alt="{{$news->image}}" style="max-height: 10vh">
                    </div>
                    <div class="form-group col-3">
                        <label for="imageInput">Image</label>
                        <div class="input-group">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="imageInput" name="image">
                                <label class="custom-file-label" for="imageInput">Choose file</label>
                            </div>
                            <div class="input-group-append">
                                <span class="input-group-text">Upload</span>
                            </div>
                        </div>
                    </div>
                    @error('image')
                        <div class="alert alert-danger" id="notif" swalType="error" swalTitle="{{$message}}" style="display: none">{{session('notif')}}</div>
                        <script> window.addEventListener("load",clickNotif);</script>	
                    @enderror
                    <div class="form-group col-2">
                        <button type="submit" class="btn btn-dark btn-block h-100">Edit Post <i class="fas fa-paper-plane p-3"></i></button>
                    </div>
                </div>
                <textarea name="content" id="summernote">
                    {{$news->content}}
                </textarea>
                @error('content')
                    <div class="alert alert-danger" id="notif" swalType="error" swalTitle="{{$message}}" style="display: none">{{session('notif')}}</div>
                    <script> window.addEventListener("load",clickNotif);</script>	
                @enderror
            </form>
        </div>
      </div>
    </div>
    <!-- /.col-->
</div>
@endsection
@section('script-body')
<!-- Summernote -->
<script src="{{asset('')}}adminlte/plugins/summernote/summernote-bs4.min.js"></script>
<!-- Select2 -->
<script src="{{asset('')}}adminlte/plugins/select2/js/select2.full.min.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="{{asset('')}}adminlte/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- bs-custom-file-input -->
<script src="{{asset('')}}adminlte/plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>
<script>
    $(function () {
      // Summernote
        $('#summernote').summernote();
      //Initialize Select2 Elements
        $('.select2').select2();
        bsCustomFileInput.init();
    })
  </script>
@endsection