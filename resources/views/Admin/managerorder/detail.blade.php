@extends('Admin.new')

@section('content')
                <div class="card-footer">
                  <button type="button" class="btn btn-success"><a href="/admin/managerorder" style="color:white;">Quay lại</a></button>
                </div>
    <div class="customer">
        <ul>
            <li>Tên: <strong>{{$orderdetails->name}}</strong></li>
            <li>Sđt: <strong>0{{$orderdetails->phone}}</strong></li>
            <li>Địa chỉ: <strong>{{$orderdetails->address}}</strong></li>
            <li>Email: <strong>{{$orderdetails->email}}</strong></li>
            <li>ghi chú: <strong>{{$orderdetails->note}}</strong></li>
        </ul>
    </div>
    <div class="cart">
    <table class="table">
                            <tbody>
                                <tr class="table_head">
									<th class="column-1">Ảnh sản phẩm</th>
									<th class="column-2"  >Tên</th>
									<th class="column-3" >Giá</th>
									<th class="column-4" >Số lượng</th>
                                    <th class="column-5"  >Kích thước</th>
                                    <th class="column-6" >Màu sắc</th>
									<th class="column-7" >&nbsp;</th>
								</tr>
                                @foreach($details as $key=>$detail)
								<tr class="table_row">
									<td class="column-1">
										<div class="how-itemcart1">
											<img src="{{$detail->product->thumb}}" style="width: 100px;" alt="IMG">
										</div>
									</td>
									<td class="column-2">{{$detail->product->name}}</td>
									<td class="column-3">{{ number_format($detail->product->price, 0,'','.')}}VND</td>
									<td class="column-4">{{$detail->quantity}}</td>
                                    <td class="column-5">{{$detail->size}}</td>
                                    <td class="column-6">{{$detail->color}}</td>
									
								</tr>

                                @endforeach
                                <tr>
                                    <td colspan="4" class="text-right">Tổng giá</td>
                                    <td>{{number_format($orderdetails->total, 0,'','.')}}VND</td>
                                </tr>
                                <tr>
                                    <td colspan="4" class="text-right">Tổng giá giảm</td>
                                    <td>{{number_format($orderdetails->total_sale, 0,'','.')}}VND</td>
                                </tr>
                                </tbody>
							</table>
    </div>
@endsection

