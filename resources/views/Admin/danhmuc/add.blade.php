@extends('Admin.new')

@section('head')
    <script src="/ckeditor/ckeditor.js"></script>
@endsection

@section('content')
                <div class="card-footer">
                  <button type="button" class="btn btn-success"><a href="/admin/danhmucs/list" style="color:white;">Danh sách danh mục</a></button>
                </div>
<form action="" method="POST">
                <div class="card-body">
                        @error('name')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                  <div class="form-group">
                    <label >Tên Danh Mục</label>
                    <input type="text" name="name" class="form-control" placeholder="Nhap ten danh muc">
                  </div>

                  <div class="form-group">
                    <label >Danh Mục</label>
                    <select class="form-control" name="parent_id">
                        <option value="0">Danh mục cha</option>
                        @foreach($dms as $danhmuc)
                            <option value="{{$danhmuc->id}}">{{$danhmuc->name}}</option>
                        @endforeach
                    </select>
                  </div>
                  <div class="form-group">
                    <label >Mô tả</label>
                    <textarea name="description" class="form-control"></textarea>
                  </div>
                  <div class="form-group">
                    <label>Mô tả chi tiết</label>
                    <textarea name="content" id="content" class="form-control"></textarea>
                  </div>
                  <div class="form-group">
                  <label>Kích hoạt</label>
                        <div class="custom-control custom-radio">
                          <input class="custom-control-input" value="1" type="radio" id="active" name="active">
                          <label for="active" class="custom-control-label">Có</label>
                        </div>
                        <div class="custom-control custom-radio">
                          <input class="custom-control-input" type="radio" value="0" id="no_active" name="active" checked="">
                          <label for="no_active" class="custom-control-label">Không</label>
                        </div>
                      </div>
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Tạo danh mục</button>
                </div>
                @csrf
              </form>
@endsection

@section('footer')
            <script>
                CKEDITOR.replace( 'content' );
            </script>
@endsection