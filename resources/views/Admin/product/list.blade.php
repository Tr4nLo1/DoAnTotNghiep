@extends('Admin.new')

@section('content')
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
body {font-family: Arial;}

/* Style the tab */
.tab {
  overflow: hidden;
  border: 1px solid #ccc;
  background-color: #f1f1f1;
}

/* Style the buttons inside the tab */
.tab button {
  background-color: inherit;
  float: left;
  border: none;
  outline: none;
  cursor: pointer;
  padding: 14px 16px;
  transition: 0.3s;
  font-size: 17px;
}

/* Change background color of buttons on hover */
.tab button:hover {
  background-color: #ddd;
}

/* Create an active/current tablink class */
.tab button.active {
  background-color: #ccc;
}

/* Style the tab content */
.tabcontent {
  display: none;
  padding: 6px 12px;
  border: 1px solid #ccc;
  border-top: none;
}
</style>
</head>
<script>
function openCity(evt, cityName) {
  var i, tabcontent, tablinks;
  tabcontent = document.getElementsByClassName("tabcontent");
  for (i = 0; i < tabcontent.length; i++) {
    tabcontent[i].style.display = "none";
  }
  tablinks = document.getElementsByClassName("tablinks");
  for (i = 0; i < tablinks.length; i++) {
    tablinks[i].className = tablinks[i].className.replace(" active", "");
  }
  document.getElementById(cityName).style.display = "block";
  evt.currentTarget.className += " active";
}
</script>



<div class="card-footer">   
        <button type="butzton" class="btn btn-success"><a href="/admin/products/add" style="color:white;">Tạo sản phẩm</a></button>
 @if($dem>0)<button class="btn btn-danger" onclick="openCity(event, 'London')">Có sản phẩm sắp hết hàng</button>@endif
        <form style="margin-left: 700px;" method="post">
          <input type="text" name="search">
          <button type="submit">Tìm kiếm</button>
          @csrf
        </form>
<div id="London" class="tabcontent">
  <table class="table">
        <thead>
            <tr>
                <th style="width: 50px;">ID</th>
                <th>Name</th>
                <th>Color</th>
                <th>Size</th>
                <th>Quantity</th>
                <th style="width: 100px;">&nbsp;</th>
            </tr>
        </thead>
        <tbody>
           @foreach($sphethangs as $key=>$sphethang)
           @foreach($products as $key=>$product)
           @if($sphethang->product_id==$product->id)
           <tr>
                <td>{{$product->id}}</td>
                <td>{{$product->name}}</td>
                <td>{{$sphethang->color}}</td>
                <td>{{$sphethang->size}}</td>
                <td>{{$sphethang->quantity}}</td>
           </tr>
           @endif
           @endforeach
           @endforeach
        </tbody>
    </table>
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
           @foreach($products as $key=>$product)
           <tr>
                <td>{{$product->id}}</td>
                <td>{{$product->name}}</td>
                <td>{{$product->price}}</td>
                <td>{{$product->description}}</td>
                <!-- <td>{{$product->content}}</td> -->
                @if($product->danhmuc_id==0)
                <td>Chưa chọn danh mục</td>
                @elseif($product->danhmuc_id!=0)
                <td>{{$product->menu->name}}</td>
                @endif
                <td>{!! \App\Helpers\Helper::active($product->active)!!}</td>
                <td>{{$product->created_at->format('d/m/Y')}}</td>
                <td><a class="btn btn-success btn-sm" href="/admin/properties/add/{{$product->id}}">
                    <i class="fas fa-plus"></i>
                    </a>
                    <a class="btn btn-primary btn-sm" href="/admin/products/edit/{{$product->id}}">
                    <i class="fas fa-edit"></i>
                    </a>
                    <a href="#" class="btn btn-danger btn-sm"
                        onclick="removeRow({{ $product->id }},'/admin/products/destroy')">
                        <i class="fas fa-trash"></i>
                    </a>
                    <a href="/admin/properties/list/{{$product->id}}"  class="btn btn-warning btn-sm">
                        <i class="fas fa-eye"></i>
                    </a>
                </td> 
           </tr>
           @endforeach
        </tbody>
    </table>
    <div class="card-footer clearfix">
    {!!$products->links()!!}
    </div>

@endsection

