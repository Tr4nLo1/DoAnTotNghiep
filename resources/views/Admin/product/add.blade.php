@extends('Admin.new')

@section('head')
    <script src="/ckeditor/ckeditor.js"></script>
@endsection

@section('content')
<div class="card-footer">
                  <button type="button" class="btn btn-success"><a href="/admin/products/list" style="color:white;">danh sách sản phẩm</a></button>
                </div>
<form action="" method="POST">
                <div class="card-body">
                        @error('name')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                <div class="row">
                    <div class="col-sm-6">
                  <div class="form-group">
                    <label >Tên</label>
                    <input type="text" name="name" value="{{old('name')}}" class="form-control" placeholder="Nhập tên sản phẩm">
                  </div>
                  </div>
                  <div class="col-sm-6">
                  <div class="form-group">
                    <label >Danh Mục</label>
                    <select class="form-control" name="danhmuc_id">
                        <option value="0">Danh mục cha</option>
                        @foreach($products as $product)
                            <option value="{{$product->id}}">{{$product->name}}</option>
                        @endforeach
                    </select>
                  </div>
                </div>
                </div>
                @error('price')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                <div class="form-group">
                    <label >Giá</label>
                    <input type="number" value="{{old('price')}}" name="price" class="form-control" placeholder="Nhập giá">
                  </div>
                  @error('description')
                        <div class="alert alert-danger">{{ $message }}</div>
                   @enderror
                  <div class="form-group">
                    <label >Mô tả</label>
                    <textarea name="description" class="form-control">{{old('description')}}</textarea> 
                  </div>
                  </div>
                  @error('content')
                        <div class="alert alert-danger">{{ $message }}</div>
                   @enderror
                  <div class="form-group">
                    <label>Mô tả chi tiết</label>
                    <textarea name="content" id="content" class="form-control">{{old('content')}}</textarea>
                  </div>
                  @error('thumb')
                        <div class="alert alert-danger">{{ $message }}</div>
                   @enderror
                  <div class="form-group">
                    <label >Ảnh</label>
                    <input type="file" id="upload" class="form-control">
                    <div id="image_show">
                    </div> 
                    <input type="hidden" name="thumb" id="thumb">
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
                  <button type="submit" class="btn btn-primary">Tạo sản phẩm</button>
                </div>
                @csrf
              </form>
@endsection

@section('footer')
            <script>
                CKEDITOR.replace( 'content' );
            </script>
@endsection