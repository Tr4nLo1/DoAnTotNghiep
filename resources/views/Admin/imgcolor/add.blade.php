@extends('Admin.new')
@section('content')
<div class="card-footer">   
                  <button type="button" class="btn btn-success"><a href="/admin/properties/list/{{$propertys->product_id}}" style="color:white;">Quay lại</a></button>
                  <button type="button" class="btn btn-success"><a href="/admin/products/list" style="color:white;">Danh sách sản phẩm</a></button>
                </div>  
                @if($slanh>=2)
                <span> Sản phẩm đã đủ số lượng ảnh </span>
                @else
<form action="" method="POST"> 
<input type="hidden" name="property_id" value="{{$propertys->id}}">  
                <div class="card-body">
                  <div class="form-group">
                    <label >Ảnh</label>
                    <input type="file" id="upload" class="form-control">
                    <div id="image_show">
                    </div> 
                    <input type="hidden" name="thumb" id="thumb">
                </div>
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Thêm ảnh</button>
                </div>
                @csrf
              </form>
              @endif
@endsection
