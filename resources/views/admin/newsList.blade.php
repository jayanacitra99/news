@extends('admin/template')
@section('title')
    News List
@endsection
@section('script-head')
    <!-- DataTables -->
    <link rel="stylesheet" href="{{asset('')}}adminlte/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="{{asset('')}}adminlte/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="{{asset('')}}adminlte/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
    <style>
        .desc {
            display: -webkit-box;
            max-width: auto;
            -webkit-line-clamp: 5;
            -webkit-box-orient: vertical;
            overflow: auto;
        }
    </style>
    <script>
    $(document).ready(function(){
        $(".buttonDelete").click(function() {
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
            if (result.isConfirmed) {
                var delurl = $(this).attr('delurl');
                window.location.replace(delurl);
            }
            })
        });

        $(".removeCat").click(function() {
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
            if (result.isConfirmed) {
                var delurl = $(this).attr('delurl');
                window.location.replace(delurl);
            }
            })
        });
    });
    </script>
@endsection
@section('content')
<div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-header">
            <a href="" class="btn btn-default" data-toggle="modal" data-target="#addCat">
                <h3 class="card-title">Add New Category</h3><i class="fas fa-pen-nib nav-icon pl-3"></i>
            </a>
            <div class="btn-group">
              <button type="button" class="btn btn-danger">Remove Category</button>
              <button type="button" class="btn btn-danger dropdown-toggle dropdown-icon" data-toggle="dropdown">
                <span class="sr-only">Toggle Dropdown</span>
              </button>
              <div class="dropdown-menu" role="menu">
                @foreach ($category as $item)
                  <a class="dropdown-item removeCat" href="#" delurl="{{url('removeCat/'.$item->id)}}">{{$item->category}}</a>    
                @endforeach
              </div>
            </div>
        </div>
        <div class="modal fade" id="addCat">
            <div class="modal-dialog modal-sm">
              <div class="modal-content">
                <div class="modal-header">
                  <h4 class="modal-title">Add New Category</h4>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  <form action="{{url('addNewCat')}}" method="post" id="addNewCat">
                    @csrf
                    <input type="text" name="category" class="form-control" placeholder="Category">
                    @error('category')
                        <div class="alert alert-danger" id="notif" swalType="error" swalTitle="{{$message}}" style="display: none">{{session('notif')}}</div>
                        <script> window.addEventListener("load",clickNotif);</script>	
                    @enderror
                  </form>
                </div>
                <div class="modal-footer justify-content-between">
                  <button type="submit" form="addNewCat" class="btn btn-primary">Add Category</button>
                </div>
              </div>
              <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
        <!-- /.card-header -->
        <div class="card-body">
          <table id="newslist" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>No. </th>
                    <th>Title</th>
                    <th>Content</th>
                    <th>Category</th>
                    <th>Image</th>
                    <th>Time Viewed</th>
                    <th>Created At</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php $no = 1;?>
                @foreach ($news as $item)
                    <tr>
                        <td>{{$no++}}</td>
                        <td class="col-2">{{$item->title}}</td>
                        <td class="desc">{{$item->content}}</td>
                        <td>
                            @foreach (unserialize($item->category) as $cat)
                                {{$cat.','}}    
                            @endforeach
                        </td>
                        <td><img src="{{asset($item->image)}}" alt="" style="max-height: 20vh;"></td>
                        <td>{{$item->viewed}}</td>
                        <td>{{$item->created_at}}</td>
                        <td>
                            <a href="{{url('newsList/editPost/'.$item->id)}}" class="btn btn-warning btn-block">Edit</a>
                            <a delurl="{{url('deletePost/'.$item->id)}}" class="btn btn-danger buttonDelete btn-block">Delete</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <th>No. </th>
                    <th>Title</th>
                    <th>Content</th>
                    <th>Category</th>
                    <th>Image</th>
                    <th>Time Viewed</th>
                    <th>Created At</th>
                    <th>Action</th>
                </tr>
            </tfoot>
          </table>
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->
    </div>
    <!-- /.col -->
</div>
<!-- /.row -->
@endsection
@section('script-body')
<!-- DataTables  & Plugins -->
<script src="{{asset('')}}adminlte/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="{{asset('')}}adminlte/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="{{asset('')}}adminlte/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="{{asset('')}}adminlte/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="{{asset('')}}adminlte/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="{{asset('')}}adminlte/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="{{asset('')}}adminlte/plugins/jszip/jszip.min.js"></script>
<script src="{{asset('')}}adminlte/plugins/pdfmake/pdfmake.min.js"></script>
<script src="{{asset('')}}adminlte/plugins/pdfmake/vfs_fonts.js"></script>
<script src="{{asset('')}}adminlte/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="{{asset('')}}adminlte/plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="{{asset('')}}adminlte/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
<script>
    $(function () {
      $("#newslist").DataTable({
        "responsive": true, "lengthChange": false, "autoWidth": false,
        "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
      }).buttons().container().appendTo('#newslist_wrapper .col-md-6:eq(0)');
    });
</script>
@endsection