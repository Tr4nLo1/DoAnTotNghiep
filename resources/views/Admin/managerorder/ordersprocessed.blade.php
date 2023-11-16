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
           @foreach($dhdaxulys as $key=>$dhdaxuly)
           <tr>
                <td>{{$dhdaxuly->id}}</td>
                <td>{{$dhdaxuly->name}}</td>
                <td>0{{$dhdaxuly->phone}}</td>
                <td>{{$dhdaxuly->email}}</td>
                <td>{{date('d-m-Y H:i:s',strtotime($dhdaxuly->time))}}</td>
                
                @if($dhdaxuly->status==2)
                <td><span class="badge badge-success"  style="font-size: medium">Đơn hàng đã được duyệt</span></td>
                <td><a href="/admin/managerorder/detail/{{$dhdaxuly->id}}"><i class="fas fa-eye"></i></td>
                @endif
           </tr>
           @endforeach
        </tbody>
    </table>
    <div class="card-footer clearfix">
    {!!$dhdaxulys->links()!!}
    </div>
@endsection

