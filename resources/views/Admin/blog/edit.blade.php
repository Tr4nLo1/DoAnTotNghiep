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
                  <div class="form-group">
                    <label >Tên</label>
                    <input type="text" name="name" value="{{$blogs->name}}" class="form-control" placeholder="Nhập tên tiêu đề">
                  </div>
                  <input type="file" id="upload" class="form-control">
                    <div id="image_show">
                        <a href="{{$blogs->thumb}}">
                            <img src="{{$blogs->thumb}}" width="100px">
                        </a>
                    </div> 
                    <input type="hidden" name="thumb" value="{{$blogs->thumb}}" id="thumb">
                  <div class="form-group">
                    <label>Mô tả chi tiết</label>
                    <textarea name="content" id="content" class="form-control">{{$blogs->content}}</textarea>
                  </div>
                  <div class="form-group">
                    <label >loại bài viết</label>
                    <select class="form-control" name="categories_id">
                    <option value="{{$blogs->categories_id}}">@foreach($categories as $categorie)
                    @if($categorie->id==$blogs->categories_id)
                    {{$categorie->name}}
                    @endif
                    @endforeach</option>
                        @foreach($categories as $categorie)
                            <option value="{{$categorie->id}}">{{$categorie->name}}</option>
                        @endforeach
                    </select>
                  </div>
                  <div class="form-group">
                  <input type="hidden" name="id_user" id="id_user" value="{{$blogs->id_user}}"  readonly>
                  </div>
                  <div class="form-group">
                  <label>Kích hoạt</label>
                        <div class="custom-control custom-radio">
                          <input class="custom-control-input" value="1" type="radio" id="active" name="active"
                          {{$blogs->active==1?'checked':''}}>
                          <label for="active" class="custom-control-label">Có</label>
                        </div>
                        <div class="custom-control custom-radio">
                          <input class="custom-control-input" type="radio" value="0" id="no_active" name="active" 
                          {{$blogs->active==0?'checked':''}}>
                          <label for="no_active" class="custom-control-label">Không</label>
                        </div>
                      </div>
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Cập nhật bài viết</button>
                </div>
                @csrf
              </form>
@endsection

@section('footer')
            <script>
                CKEDITOR.replace( 'content' );
            </script>
@endsection