@extends('layouts.app')
@section('content')
<div class="container">
    <div class="data" style="background-color: #E6E6FA; padding:50px">
        <h1 style="text-align:center;">{{ !empty($data->id) ? 'แก้ไข' : 'เพิ่ม' }}ประเภทสินค้า </h1>
        <!-- @if( count($errors) > 0 )
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
                <ul>
                    @foreach( $errors->all() as $error )
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
            </div>
        @endif -->
        @if(!empty($data->id))
        <form action="{{ action('ProductTypeController@update',$data->id) }}" method="post" enctype="multipart/form-data">
        <input type="hidden" name="_method" value="PUT">
        @else
        <form method="POST" action="{{ url('type') }}" enctype="multipart/form-data"> 
        @endif
@csrf  
            <div class="form-group">
                <label for="Name">ชื่อประเภทสินค้า</label>
                <input type="text" name="name" class="form-control {{ !empty( $errors->first('name')) ? 'is-invalid' : '' }}" value="{{ !empty($data->name) ? $data->name: old('name') }}" >
                @if(!empty( $errors->first('name')))
          <div class="text-danger">- {{ $errors->first('name') }} </div> 
        @endif
            </div>
            <div class="button" style="margin-left:400px;">
                <button type="submit" class="btn btn-primary">บันทึก</button>
                <button type="reset" class="btn btn-warning">ล้างมิอ</button>
                <a href="{{ url('type')}}" class="btn btn-danger">ย้อนกลับ</a>
            </div>
        </form>
    </div>
</div>
@endsection
