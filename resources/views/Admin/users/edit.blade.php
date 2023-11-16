@extends('Admin.new')

@section('content')
<div class="card-footer">
                  <button type="button" class="btn btn-success"><a href="/admin/user/list" style="color:white;">danh sách người dùng</a></button>
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
                    <input type="text"  name="name" value="{{$users->name}}"  class="form-control" placeholder="Nhap ten user">
                  </div>
                  </div>
                  <div class="col-sm-6">
                  <div class="form-group">
                    <label >Email</label>
                    <input  type="email" name="email" value="{{$users->email}}"  class="form-control" placeholder="Nhap email user">
                  </div>
                </div>
                </div>
                <div class="row">

                  <div class="col-sm-6">
                  <div class="form-group">
                    <label >Số điện thoại</label>
                    <input  type="numberphone" name="phone" value="0{{$users->phone}}" class="form-control" placeholder="Nhap number phone">
                  </div>
                </div>
                </div>
                <div class="form-group">
                    <label >Địa chỉ</label>
                    <input type="text" name="address" value="{{$users->address}}" class="form-control" placeholder="Nhap address">
                  </div>
                  <div class="form-group">
                    <label >Giới tính:</label>
                    <input type="radio" name="sex" style="margin-left: 60px;"  value="1"
                    {{$users->sex==1?'checked':''}}><label>Nam</label>
						<input type="radio" name="sex" style="margin-left: 60px;" value="0"
                        {{$users->sex==0?'checked':''}}><label >Nữ</label>
                  </div>
                  <input class="stext-111 cl2 plh3 size-116 p-l-62 p-r-30" type="hidden" name="id_role"  value="2">
                  <div class="form-group">
                  <label>Kích hoạt</label>
                        <div class="custom-control custom-radio">
                          <input class="custom-control-input" value="1" type="radio" id="active" name="active"
                          {{$users->active==1?'checked':''}}>
                          <label for="active" class="custom-control-label">Có</label>
                        </div>
                        <div class="custom-control custom-radio">
                          <input class="custom-control-input" type="radio" value="0" id="no_active" name="active" 
                          {{$users->active==0?'checked':''}}>
                          <label for="no_active" class="custom-control-label">Không</label>
                        </div>
                      </div>
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Cập nhật người dùng</button>
                </div>
                @csrf
              </form>
@endsection

