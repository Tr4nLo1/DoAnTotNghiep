@extends('Admin.new')

@section('content')
<div class="card-footer">   
                  <button type="button" class="btn btn-success"><a href="/admin/properties/add/{{$products->id}}" style="color:white;">Tạo chi tiết sản phẩm id: {{$products->id}}</a></button>
                  <button type="button" class="btn btn-success"><a href="/admin/products/list" style="color:white;">Danh sách sản phẩm</a></button>
                </div>              
<input type="hidden" name="product_id" value="{{$products->id}}">
    <table class="table">
        <thead>
            <tr>
                <th style="width: 50px;">Mã</th>
                <th>Màu sắc</th>
                <th>kích thước</th>
                <th>số lượng</th>
                <th>Mã sản phẩm</th>
                <th>Ảnh</th>
                <th></th>
                <th style="width: 100px;">&nbsp;</th>
            </tr>
        </thead>
        <tbody>
        @foreach($properties as $key=>$propertie)
        @if($propertie->product_id==$products->id)
           <tr>
                <td>{{$propertie->id}}</td>
                <td>{{$propertie->color}}</td>
                <td>{{$propertie->size}}</td>
                <td>{{$propertie->quantity}}</td>
                <td>{{$propertie->getproduct->id}}</td>
                <td>
                @foreach($imgs as $img)
                @if($propertie->id==$img->property_id)
                <a href="{{$img->thumb}}" target="_blank">
                    <img src="{{$img->thumb}}" height="40px">
                    </a>
                
                @endif
                @endforeach
                </td>
                <td>
                    <a class="btn btn-success btn-sm" href="/admin/imgs/add/{{$propertie->id}}">
                    <i class="fas fa-plus"></i>
                    </a>
                    <a class="btn btn-primary btn-sm" href="/admin/properties/edit/{{$propertie->id}}">
                    <i class="fas fa-edit"></i>
                    </a>
                    <a href="#" class="btn btn-danger btn-sm"
                        onclick="removeRow({{ $propertie->id }},'/admin/properties/destroy')">
                        <i class="fas fa-trash"></i>
                    </a>
                </td> 
           </tr>
           @endif
        @endforeach
        </tbody>
    </table>
@endsection

