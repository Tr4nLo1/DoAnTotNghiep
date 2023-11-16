@extends('Admin.new')


@section('content')
<form action="" method="POST">
                <div class="card-body">
                        @error('name')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                        @error('url')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
            <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label >Tiêu đề</label>
                    <input type="text" name="name" value="{{$banners->name}}" class="form-control" placeholder="Nhập tên tiêu đề">
                  </div>
                  </div>
                  <div class="col-md-6">
                  <div class="form-group">
                    <label >Đường dẫn</label>
                    <input type="text" name="url" value="{{$banners->url}}" class="form-control" placeholder="Nhập đường dẫn">
                  </div>
                </div>
            </div>
                        @error('thumb')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                  <div class="form-group">
                    <label >Ảnh</label>
                    <input type="file" id="upload" class="form-control">
                    <div id="image_show">
                        <a href="{{$banners->thumb}}">
                            <img src="{{$banners->thumb}}" width="100px">
                        </a>
                    </div> 
                    <input type="hidden" name="thumb" value="{{$banners->thumb}}" id="thumb">
                </div>
                <div class="form-group">
                    <label >Sắp xếp</label>
                    <input type="number" name="sort_by" value="{{$banners->sort_by}}" class="form-control">
                  </div>
                  <div class="form-group">
                  <label>Kích hoạt</label>
                        <div class="custom-control custom-radio">
                          <input class="custom-control-input" value="1" type="radio" id="active" name="active"
                          {{$banners->active==1?'checked':''}}>
                          <label for="active" class="custom-control-label">Có</label>
                        </div>
                        <div class="custom-control custom-radio">
                          <input class="custom-control-input" type="radio" value="0" id="no_active" name="active" 
                          {{$banners->active==0?'checked':''}}>
                          <label for="no_active" class="custom-control-label">Không</label>
                        </div>
                      </div>
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Cập nhật quảng cáo</button>
                </div>
                @csrf
              </form>
@endsection
