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
           @foreach($dhtuchois as $key=>$dhtuchoi)
           <tr>
                <td>{{$dhtuchoi->id}}</td>
                <td>{{$dhtuchoi->name}}</td>
                <td>0{{$dhtuchoi->phone}}</td>
                <td>{{$dhtuchoi->email}}</td>
                <td>{{date('d-m-Y H:i:s',strtotime($dhtuchoi->time))}}</td>
                
                @if($dhtuchoi->status==3)
                <td><span class="badge badge-secondary"  style="font-size: medium">Đơn hàng không được duyệt</span></td> 
                <td><a href="/admin/managerorder/detail/{{$dhtuchoi->id}}"><i class="fas fa-eye"></i></td>
                @endif
           </tr>
           @endforeach
        </tbody>
    </table>
    <div class="card-footer clearfix">
    {!!$dhtuchois->links()!!}
    </div>
@endsection

