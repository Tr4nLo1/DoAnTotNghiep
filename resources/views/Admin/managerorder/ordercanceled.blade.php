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
           @foreach($dhbihuys as $key=>$dhbihuy)
           <tr>
                <td>{{$dhbihuy->id}}</td>
                <td>{{$dhbihuy->name}}</td>
                <td>0{{$dhbihuy->phone}}</td>
                <td>{{$dhbihuy->email}}</td>
                <td>{{date('d-m-Y H:i:s',strtotime($dhbihuy->time))}}</td>
                @if($dhbihuy->status==4)
                <td><span class="badge badge-danger"  style="font-size: medium">Đơn hàng đã bị huỷ</span></td> 
                <td><a href="/admin/managerorder/detail/{{$dhbihuy->id}}"><i class="fas fa-eye"></i></td>
                @endif
           </tr>
           @endforeach
        </tbody>
    </table>
    <div class="card-footer clearfix">
    {!!$dhbihuys->links()!!}
    </div>
@endsection

