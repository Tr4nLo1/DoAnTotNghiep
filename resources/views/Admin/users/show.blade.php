@extends('Admin.new')

@section('content')
    <table class="table">
        <thead>
            <tr>
                <th style="width: 50px;">ID</th>
                <th>Tên</th>
                <th>Email</th>
                <th>Giới Tính</th>
                <th>Sđt</th>
                <th>Địa chỉ</th>
                <th>Ngày Tạo</th>
                <th>Trạng thái</th>
                <th>Option</th>
                <th style="width: 100px;">&nbsp;</th>
            </tr>
        </thead>
        @foreach($users as $user)
        <tr>
                <td>{{$user->id}}</td>
                <td>{{$user->name}}</td>
                <td>{{$user->email}}</td>
                @if($user->sex==1)
                <td>Nam</td>
                @else 
                    <td>Nữ</td>
                @endif
                <td>0{{$user->phone}}</td>
                <td>{{$user->address}}</td>
                <td>{{$user->created_at->format('d/m/Y H:i:s')}}</td>
                <td>@if($user->active==1)
                <span class="btn btn-success btn-xs">YES</span>
                @else
                <span class="btn btn-danger btn-xs">NO</span>
                @endif</td>
                <td><a class="btn btn-primary btn-sm" href="/admin/user/edit/{{$user->id}}">
                    <i class="fas fa-edit"></i>
                    </a>
                    <a class="btn btn-primary btn-sm" href="/admin/user/send/{{$user->id}}">
                    <i class="far fa-paper-plane"></i>
                    </a>
                </td>
                </tr>
        @endforeach
    </table>
@endsection

