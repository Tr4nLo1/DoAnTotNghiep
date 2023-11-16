@extends('Admin.new')

@section('head')
    <script src="/ckeditor/ckeditor.js"></script>
@endsection

@section('content')
<form action="" method="POST">
                <div class="card-body">
                        @error('name')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                <div class="row">
                    <div class="col-sm-6">
                  <div class="form-group">
                    <label >Tên</label>
                    <input type="text" name="name" value="{{$product->name}}" class="form-control" placeholder="Nhap ten san pham">
                  </div>
                  </div>
                  <div class="col-sm-6">
                    
                  <div class="form-group">
                    <label >Danh Mục</label>
                    <select class="form-control" name="danhmuc_id">
                        @foreach($danhmucs as $danhmuc)
                            <option value="{{$danhmuc->id}}"
                            {{$product->danhmuc_id==$danhmuc->id?'selected':''}}>
                            {{$danhmuc->name}}
                        </option>
                        @endforeach
                    </select>
                  </div>

                </div>
                </div>
                <div class="form-group">
                    <label >Giá</label>
                    <input type="text" name="price"  value="{{$product->price}}" class="form-control" placeholder="Nhap gia">
                  </div>
                  @error('description')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                  <div class="form-group">
                    <label >Mô tả</label>
                    <textarea name="description" class="form-control">{{$product->description}}</textarea>
                  </div>
                  <div class="form-group">
                    <label>Mô tả chi tiết</label>
                    <textarea name="content" id="content" class="form-control">{{$product->content}}</textarea>
                  </div>
                  <div class="form-group">
                  <label>Kích hoạt</label>
                        <div class="custom-control custom-radio">
                          <input class="custom-control-input" value="1" type="radio" id="active" name="active" 
                          {{$product->active==1?'checked=""':''}}>
                          <label for="active" class="custom-control-label">Có</label>
                        </div>
                        <div class="custom-control custom-radio">
                          <input class="custom-control-input" type="radio" value="0" id="no_active" name="active"
                          {{$product->active==0?'checked=""':''}}>
                          <label for="no_active" class="custom-control-label">Không</label>
                        </div>
                      </div>
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Cập nhật sản phẩm</button>
                </div>
                @csrf
              </form>
@endsection

@section('footer')
            <script>
                CKEDITOR.replace( 'content' );
            </script>
@endsection