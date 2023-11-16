@extends('Admin.new')

@section('content')
<div class="card-footer">   
<button type="butzton" class="btn btn-success"><a href="/admin/managerorder" style="color:white;">Tất cả đơn hàng</a></button>
</div>
<table class="table">
        <thead>
            <tr>
                <th style="width: 50px;">Mã</th>
                <th>Tên</th>
                <th>Sđt</th>
                <th>Email</th>
                <th>Thời gian</th>
                <th>Trạng thái</th>
                <th></th>
                <th style="width: 100px;">&nbsp;</th>
            </tr>
        </thead>
        <tbody>
            <h1></h1>
           @foreach($dhxulys as $key=>$dhxuly)
           <tr>
                <td>{{$dhxuly->id}}</td>
                <td>{{$dhxuly->name}}</td>
                <td>0{{$dhxuly->phone}}</td>
                <td>{{$dhxuly->email}}</td>
                <td>{{date('d-m-Y H:i:s',strtotime($dhxuly->time))}}</td>
                @if($dhxuly->status==1)
                <td><span class="badge badge-warning"  style="font-size: medium">Đang chờ xử lý</span></td>          
                <td><a href="/admin/managerorder/detail/{{$dhxuly->id}}"><i class="fas fa-eye"></i></td>
                <td><a href="/admin/managerorder/success/{{$dhxuly->id}}"><i class="fas fa-check"></i></td>
                <td><a onclick="return confirm('Bạn có chắc là muốn từ chối đơn hàng này không?')" href="/admin/managerorder/cancel/{{$dhxuly->id}}"><i class="fas fa-times"></i></td>
                @endif
           </tr>
           @endforeach
        </tbody>
    </table>
    <div class="card-footer clearfix">
    {!!$dhxulys->links()!!}
    </div>
@endsection

