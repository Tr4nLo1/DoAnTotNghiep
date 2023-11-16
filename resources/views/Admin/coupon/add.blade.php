@extends('Admin.new')



@section('content')
<div class="card-footer">
                  <button type="button" class="btn btn-success"><a href="/admin/coupons/list" style="color:white;">danh sách mã giảm giá</a></button>
                </div>
<form action="" method="POST">
                <div class="card-body">
                        @error('name')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                <div class="row">
                    <div class="col-sm-6">
                  <div class="form-group">
                    <label >Tên mã giảm giá</label>
                    <input type="text" name="name" class="form-control" >
                  </div>
                  </div>
                  <div class="col-sm-6">
                  <div class="form-group">
                    <label >Mã giảm giá</label>
                    <input type="text" name="code" class="form-control" >
                  </div>
                </div>
                </div>
                <div class="row">
                    <div class="col-sm-6">
                  <div class="form-group">
                    <label >Số lượng mã</label>
                    <input type="text" name="amount" class="form-control">
                  </div>
                  </div>
                  <div class="col-sm-6">
                  <div class="form-group">
                    <label >Tính năng mã</label>
                    <select class="form-control" name="select">
                        <option value="0">Chọn</option>
                        <option value="1">Giảm theo phần trăm</option>
                        <option value="2">Giảm theo tiền</option>
                    </select>
                  </div>
                </div>
                </div>
                <div class="form-group">
                    <label >Nhập số % hoặc số tiền giảm</label>
                    <input type="number" name="number" class="form-control">
                  </div>             
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Tạo mã giảm giá</button>
                </div>
                @csrf
              </form>
@endsection
