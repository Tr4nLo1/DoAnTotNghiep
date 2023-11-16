@extends('Admin.new')

@section('content')
<div class="card-footer">   
                  <button type="button" class="btn btn-success"><a href="/admin/blogs/add" style="color:white;">Tạo bài viết</a></button>
                  <button type="button" class="btn btn-success"><a href="/admin/categories/add" style="color:white;">Tạo loại bài viêt</a></button>
                </div>
    <table class="table">
        <thead>
            <tr>
                <th style="width: 50px;">Mã</th>
                <th>Tên</th>
                <th>Ảnh</th>
                <th>Nội dung</th>
                <th>loại bài viết</th>
                <th>người viết</th>
                <th>Trạng thái</th>
                <th>Ngày cập nhật</th>
                <th style="width: 100px;">&nbsp;</th>
            </tr>
        </thead>
        <tbody>
           @foreach($blogs as $key=>$blog)
           <tr>
                <td>{{$blog->id}}</td>
                <td>{{$blog->name}}</td>
                <td><a href="{{$blog->thumb}}" target="_blank">
                    <img src="{{$blog->thumb}}" height="40px">
                    </a>
                </td>
                <td>@foreach($cates as $cate)
                    @if($cate->id==$blog->categories_id)
                    {{$cate->name}}
                    @endif
                    @endforeach</td>
                <td>{{$blog->nameuser->name}}</td>
                <td>{!! \App\Helpers\Helper::active($blog->active)!!}</td>
                <td>{{$blog->updated_at->format('d/m/Y')}}</td>
                <td><a class="btn btn-primary btn-sm" href="/admin/blogs/edit/{{$blog->id}}">
                    <i class="fas fa-edit"></i>
                    </a>
                    <a href="#" class="btn btn-danger btn-sm"
                        onclick="removeRow({{ $blog->id }},'/admin/blogs/destroy')">
                        <i class="fas fa-trash"></i>
                    </a>
                </td>
           </tr>
           @endforeach
        </tbody>
    </table>
    <div class="card-footer clearfix">
    {!!$blogs->links()!!}
    </div>
@endsection

