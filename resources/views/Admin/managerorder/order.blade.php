@extends('Admin.new')

@section('content')

<div class="card-footer">
<button type="butzton" class="btn btn-info"><a href="/admin/managerorder/arebeingprocessed" style="color:white;">Đơn hàng chờ xử lý</a></button>
<button type="butzton" class="btn btn-info"><a href="/admin/managerorder/ordercanceled" style="color:white;">Đơn hàng bị huỷ</a></button>
<button type="butzton" class="btn btn-info"><a href="/admin/managerorder/orderrefused" style="color:white;">Đơn hàng bị từ chối</a></button>
<button type="butzton" class="btn btn-info"><a href="/admin/managerorder/ordersprocessed" style="color:white;">Đơn hàng đã duyệt</a></button>
<form style="margin-left: 700px;" method="post">
          <input type="text" name="searchemail">
          <button type="submit">Tìm kiếm</button>
          @csrf
        </form>
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
           @foreach($orders as $key=>$order)
           <tr>
                <td>{{$order->id}}</td>
                <td>{{$order->name}}</td>
                <td>0{{$order->phone}}</td>
                <td>{{$order->email}}</td>
                <td>{{date('d-m-Y H:i:s',strtotime($order->time))}}</td>
                @if($order->status==1)
                <td><span class="badge badge-warning"  style="font-size: medium">Đang chờ xử lý</span></td>          
                <td><a href="/admin/managerorder/detail/{{$order->id}}"><i class="fas fa-eye"></i></td>
                <td><a href="/admin/managerorder/success/{{$order->id}}"><i class="fas fa-check"></i></td>
                <td><a onclick="return confirm('Bạn có chắc là muốn từ chối đơn hàng này không?')" href="/admin/managerorder/cancel/{{$order->id}}"><i class="fas fa-times"></i></td>
                @elseif($order->status==2)
                <td><span class="badge badge-success"  style="font-size: medium">Đơn hàng đã được duyệt</span></td>
                <td><a href="/admin/managerorder/detail/{{$order->id}}"><i class="fas fa-eye"></i></td>
                @elseif($order->status==3)
                <td><span class="badge badge-secondary"  style="font-size: medium">Đơn hàng không được duyệt</span></td> 
                <td><a href="/admin/managerorder/detail/{{$order->id}}"><i class="fas fa-eye"></i></td>
                @elseif($order->status==4)
                <td><span class="badge badge-danger"  style="font-size: medium">Đơn hàng đã bị huỷ</span></td> 
                <td><a href="/admin/managerorder/detail/{{$order->id}}"><i class="fas fa-eye"></i></td>
                @endif
           </tr>
           @endforeach
        </tbody>
    </table>
    <div class="card-footer clearfix">
    {!!$orders->links()!!}
    </div>
@endsection

