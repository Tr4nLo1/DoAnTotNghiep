@extends('Admin.new')

@section('content')
<div class="card-footer">
                  <button type="button" class="btn btn-success"><a href="/admin/products/list" style="color:white;">danh sách sản phẩm</a></button>
                </div>
<table class="table"  id="products">
        <thead>
            <tr>
                <th style="width: 50px;">Mã</th>
                <th>Tên</th>
                <th>Giá</th>
                <th>Mô tả</th>
                <!-- <th>content</th> -->
                <th>Loại sản phẩm</th>
                <th>Trạng thái</th>
                <th>Ngày tạo</th>
                <th style="width: 100px;">&nbsp;</th>
            </tr>
        </thead>
        <tbody>
            <h1></h1>
           @foreach($search_products as $key=>$search_product)
           <tr>
                <td>{{$search_product->id}}</td>
                <td>{{$search_product->name}}</td>
                <td>{{$search_product->price}}</td>
                <td>{{$search_product->description}}</td>
               
                <td>{{$search_product->menu->name}}</td>
                <td>{!! \App\Helpers\Helper::active($search_product->active)!!}</td>
                <td>{{$search_product->created_at->format('d/m/Y')}}</td>
                <td><a class="btn btn-success btn-sm" href="/admin/properties/add/{{$search_product->id}}">
                    <i class="fas fa-plus"></i>
                    </a>
                    <a class="btn btn-primary btn-sm" href="/admin/products/edit/{{$search_product->id}}">
                    <i class="fas fa-edit"></i>
                    </a>
                    <a href="#" class="btn btn-danger btn-sm"
                        onclick="removeRow({{ $search_product->id }},'/admin/products/destroy')">
                        <i class="fas fa-trash"></i>
                    </a>
                    <a href="/admin/properties/list/{{$search_product->id}}"  class="btn btn-warning btn-sm">
                        <i class="fas fa-eye"></i>
                    </a>
                </td> 
           </tr>
           @endforeach
        </tbody>
    </table>
    <div class="card-footer clearfix">
    {!!$search_products->links()!!}
    </div>
@endsection