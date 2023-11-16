@extends('Admin.new')

@section('head')
    <script src="/ckeditor/ckeditor.js"></script>
@endsection

@section('content')
<div class="card-footer">   
                  <button type="button" class="btn btn-success"><a href="/admin/blogs/list" style="color:white;">danh sách bài viết</a></button>
                  
                </div>
<form action="" method="POST">
                <div class="card-body">
                        @error('name')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                  <div class="form-group">
                    <label >Tên</label>
                    <input type="text" name="name" class="form-control" placeholder="Nhập tên loại bài viết">
                  </div>
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Tạo loại bài viết</button>
                </div>
                @csrf
              </form>
@endsection

@section('footer')
            <script>
                CKEDITOR.replace( 'content' );
            </script>
@endsection