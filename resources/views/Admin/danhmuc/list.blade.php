@extends('Admin.new')

@section('content')

                <div class="card-footer">
                  <button type="button" class="btn btn-success"><a href="/admin/danhmucs/add" style="color:white;">Tạo danh mục</a></button>
                </div>
    <table class="table">
    <thead>
            <tr>
                <th style="width: 50px;">Mã</th>
                <th>Tên</th>
                <th>Trạng thái</th>
                <th>Ngày cập nhật</th>
                <th style="width: 100px;">&nbsp;</th>
            </tr>
        </thead>
        <tbody>
            {!!\App\Helpers\Helper::danhmuc($dms)!!}
        </tbody>
    </table>
@endsection

