@extends('Admin.new')

@section('content')
<div class="card-footer">   
                  <button type="button" class="btn btn-success"><a href="/admin/coupons/add" style="color:white;">Tạo mã giảm giá</a></button>
                  
                </div>
    <table class="table">
        <thead>
            <tr>
                <th style="width: 50px;">Mã</th>
                <th>Tên mã giảm giá</th>
                <th>Mã giả giá</th>
                <th>Số lượng</th>
                <th>Tính năng</th>
                <th>Nội dung</th>
                <th></th>
                <th style="width: 100px;">&nbsp;</th>
            </tr>
        </thead>
        <tbody>
           @foreach($coupons as $key=>$coupon)
           <tr>
                <td>{{$coupon->id}}</td>
                <td>{{$coupon->name}}</td>
                <td>{{$coupon->code}}</td>
                <td>{{$coupon->amount}}</td>
                @if(($coupon->select)==1)
                <td>Giảm theo %</td>
                @elseif(($coupon->select)==2)
                <td>Giảm theo tiền</td>
                @endif
                @if(($coupon->select)==1)
                <td>Giảm {{$coupon->number}} %</td>
                @elseif(($coupon->select)==2)
                <td>Giảm {{ number_format($coupon->number, 0,'',',')}} VND</td>
                @endif
                <td><a class="btn btn-primary btn-sm" href="/admin/coupons/edit/{{$coupon->id}}">
                    <i class="fas fa-edit"></i>
                    </a>
                    <a href="#" class="btn btn-danger btn-sm"
                        onclick="removeRow({{ $coupon->id }},'/admin/coupons/destroy')">
                        <i class="fas fa-trash"></i>
                    </a>
                </td>
           </tr>
           @endforeach
        </tbody>
    </table>
    <div class="card-footer clearfix">
    {!!$coupons->links()!!}
    </div>
@endsection

