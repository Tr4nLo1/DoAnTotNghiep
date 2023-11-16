@extends('Admin.new')
@section('content')
<h3>Mã chi tiết sản phẩm: {{$propertys->id}}</h3>
<form action="" method="POST">
                <div class="card-body">
                        @error('color')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    <body>
                    <div class="row">
                    <div class="col-sm-6">
                  <div class="form-group">
                    <label >Màu sắc</label>
                    <input type="text" name="color" value="{{$propertys->color}}" class="form-control" placeholder="Nhap mau">
                  </div>
                    </div>
                    <div class="col-sm-6">
                  <div class="form-group">
                    <label >Kích thước</label>
                    <input type="text" name="size" value="{{$propertys->size}}"  class="form-control" placeholder="Nhap size">
                  </div>
                  </div>
                  </div>
                  <div class="form-group">
                    <label >Số lượng</label>
                    <input type="number" name="quantity" value="{{$propertys->quantity}}" class="form-control" placeholder="Nhap so luong">
                  </div>
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Cập nhật chi tiết sản phẩm</button>
                </div>
                @csrf
              </form>
@endsection
