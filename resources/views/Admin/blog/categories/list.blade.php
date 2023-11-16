@extends('Admin.new')

@section('content')

    <table class="table">
        <thead>
            <tr>
                <th style="width: 50px;">ID</th>
                <th>Ten</th>
                <th style="width: 100px;">&nbsp;</th>
            </tr>
        </thead>
        <tbody>
           @foreach($categories as $key=>$categorie)
           <tr>
                <td>{{$categorie->id}}</td>
                <td>{{$categorie->name}}</td>
                
                <td>
                    <a href="#" class="btn btn-danger btn-sm"
                        onclick="removeRow({{ $categorie->id }},'/admin/blogs/destroy')">
                        <i class="fas fa-trash"></i>
                    </a>
                </td>
           </tr>
           @endforeach
        </tbody>
    </table>
    <div class="card-footer clearfix">
    {!!$categories->links()!!}
    </div>
@endsection

