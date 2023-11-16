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
           @foreach($search_emails as $search_email)
            @foreach($momos as $momo)
                @if($search_email->id==$momo->id_order)
           <tr>
                <td>{{$search_email->id}}</td>
                <td>{{$search_email->name}}</td>
                <td>0{{$search_email->phone}}</td>
                <td>{{$search_email->email}}</td>
                <td>{{date('d-m-Y H:i:s',strtotime($search_email->time))}}</td>
                <td>Đã thanh toán</td>
                <td><span class="badge badge-success"  style="font-size: medium">Đơn hàng đã được duyệt</span></td>
                <td><a href="/admin/managerorder/momodetail/{{$search_email->id}}"><i class="fas fa-eye"></i></td>
           </tr>
                @endif
            @endforeach
           @endforeach
        </tbody>
    </table>
    <div class="card-footer clearfix">
    
    </div>
@endsection