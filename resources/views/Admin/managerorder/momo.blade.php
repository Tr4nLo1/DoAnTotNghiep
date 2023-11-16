@extends('Admin.new')

@section('content')
<div class="card-footer">
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
                <th style="width: 100px;">&nbsp;</th>
            </tr>
        </thead>
        <tbody>
            <h1></h1>
           @foreach($momos as $key=>$momo)
           <tr>
                <td>{{$momo->id}}</td>
                <td>{{$momo->getidorder->name}}</td>
                <td>0{{$momo->getidorder->phone}}</td>
                <td>{{$momo->getidorder->email}}</td>
                <td>{{date('d-m-Y H:i:s',strtotime($momo->getidorder->time))}}</td>
                <td>Đã thanh toán</td>
                @if($momo->getidorder->status==1)
                <td><span class="badge badge-warning"  style="font-size: medium">Đang chờ xử lý</span></td>          
                <td><a href="/admin/managerorder/momodetail/{{$momo->getidorder->id}}"><i class="fas fa-eye"></i></td>
                <td><a href="/admin/managerorder/momodetail/success/{{$momo->getidorder->id}}"><i class="fas fa-check"></i></td>
                <td><a onclick="return confirm('Bạn có chắc là muốn từ chối đơn hàng này không?')" href="/admin/managerorder/momodetail/cancel/{{$momo->getidorder->id}}"><i class="fas fa-times"></i></td>
                @elseif($momo->getidorder->status==2)
                <td><span class="badge badge-success"  style="font-size: medium">Đơn hàng đã được duyệt</span></td>
                <td><a href="/admin/managerorder/momodetail/{{$momo->getidorder->id}}"><i class="fas fa-eye"></i></td>
                @elseif($momo->getidorder->status==3)
                <td><span class="badge badge-secondary"  style="font-size: medium">Đơn hàng không được duyệt</span></td> 
                <td><a href="/admin/managerorder/momodetail/{{$momo->getidorder->id}}}"><i class="fas fa-eye"></i></td>
                @endif
           </tr>
           @endforeach
        </tbody>
    </table>
    <div class="card-footer clearfix">
    {!!$momos->links()!!}
    </div>
@endsection