@extends('Admin.new')
@section('content')
<div class="card-footer">
                  <button type="button" class="btn btn-success"><a href="/admin/products/list" style="color:white;">danh sách sản phẩm</a></button>
                  <button type="button" class="btn btn-success"><a href="/admin/properties/list/{{$products->id}}" style="color:white;">danh sách chi tiết sản phẩm</a></button>
                </div>

<form action="" method="POST">
              <input type="hidden" name="product_id" value="{{$products->id}}">  
                <div class="card-body">
                        @error('color')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    <body>
                    <div class="row">
                    <div class="col-sm-6">
                  <div class="form-group">
                    <label >Màu sắc</label>
                    <input type="text" name="color" class="form-control" placeholder="Nhập màu">
                  </div>
                    </div>
                    <div class="col-sm-6">
                  <div class="form-group">
                    <label >Kính thước</label>
                    <input type="text" name="size" class="form-control" placeholder="Nhập size">
                  </div>
                  </div>
                  </div>
                  <div class="card-body">
                        @error('thumb')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                        </div>
                  <div class="form-group">
                    <label >Số lượng</label>
                    <input type="number" name="quantity" class="form-control" placeholder="Nhập số lượng">
                  </div>
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Thêm chi tiết sản phẩm</button>
                </div>
                @csrf
              </form>
@endsection
