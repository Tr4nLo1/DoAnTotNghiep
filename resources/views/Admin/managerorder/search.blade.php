@extends('Admin.new')

@section('content')

<div class="card-footer">
<button type="butzton" class="btn btn-info"><a href="/admin/managerorder/" style="color:white;">Quay lại</a></button>
<button type="butzton" class="btn btn-info"><a href="/admin/managerorder/arebeingprocessed" style="color:white;">Đơn hàng chờ xử lý</a></button>
<button type="butzton" class="btn btn-info"><a href="/admin/managerorder/ordercanceled" style="color:white;">Đơn hàng bị huỷ</a></button>
<button type="butzton" class="btn btn-info"><a href="/admin/managerorder/orderrefused" style="color:white;">Đơn hàng không được duyệt</a></button>
<button type="butzton" class="btn btn-info"><a href="/admin/managerorder/ordersprocessed" style="color:white;">Đơn hàng được duyệt</a></button>
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
           @foreach($search_emails as $key=>$search_email)
           <tr>
                <td>{{$search_email->id}}</td>
                <td>{{$search_email->name}}</td>
                <td>0{{$search_email->phone}}</td>
                <td>{{$search_email->email}}</td>
                <td>{{date('d-m-Y H:i:s',strtotime($search_email->time))}}</td>
                @if($search_email->status==1)
                <td><span class="badge badge-warning"  style="font-size: medium">Đang chờ xử lý</span></td>          
                <td><a href="/admin/managerorder/detail/{{$search_email->id}}"><i class="fas fa-eye"></i></td>
                <td><a href="/admin/managerorder/success/{{$search_email->id}}"><i class="fas fa-check"></i></td>
                <td><a onclick="return confirm('Bạn có chắc là muốn từ chối đơn hàng này không?')" href="/admin/managerorder/cancel/{{$search_email->id}}"><i class="fas fa-times"></i></td>
                @elseif($search_email->status==2)
                <td><span class="badge badge-success"  style="font-size: medium">Đơn hàng đã được duyệt</span></td>
                <td><a href="/admin/managerorder/detail/{{$search_email->id}}"><i class="fas fa-eye"></i></td>
                @elseif($search_email->status==3)
                <td><span class="badge badge-secondary"  style="font-size: medium">Đơn hàng không được duyệt</span></td> 
                <td><a href="/admin/managerorder/detail/{{$search_email->id}}"><i class="fas fa-eye"></i></td>
                @elseif($search_email->status==4)
                <td><span class="badge badge-danger"  style="font-size: medium">Đơn hàng đã bị huỷ</span></td> 
                <td><a href="/admin/managerorder/detail/{{$search_email->id}}"><i class="fas fa-eye"></i></td>
                @endif
           </tr>
           @endforeach
        </tbody>
    </table>
    <div class="card-footer clearfix">
    {!!$search_emails->links()!!}
    </div>
@endsection

