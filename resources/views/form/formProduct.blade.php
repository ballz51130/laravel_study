@extends('layouts.app')
@section('content')
<div class="container">
    <div class="data" style="background-color: #E6E6FA; padding:50px">
        <h1 style="text-align:center;">{{ !empty($data->id) ? 'แก้ไข' : 'เพิ่ม' }}ข้อมูลสินค้า </h1>
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
        <form action="{{ action('ProductsController@update',$data->id) }}" method="post" enctype="multipart/form-data">
        <input type="hidden" name="_method" value="PUT">
        @else
        <form method="POST" action="{{ url('product') }}" enctype="multipart/form-data"> 
        @endif
@csrf  
<div class="form-group">
    <label for="my-input">ประเภทสินค้า</label>
        <select class="form-control {{ !empty( $errors->first('type')) ? 'is-invalid' : '' }}" name="type" id="type"  >
        <option value="" class="form-control">-เลือกประเภทสินค้า-</option>
        @foreach( $type AS $key => $value )
        @php
            $sel = '';
        @endphp

        @if( !empty($data->type) )
            @if($value->id == $data->type )
                @php
                    $sel='selected="1"';
                @endphp
            @endif
        @endif
             @if($value->id == old('type'))
             @php
                $sel = 'selected="1"';
             @endphp  
         @endif     
         <option class="form-control" {{ $sel }} value="{{ $value->id }}"> {{ $value->name }} </option>
        @endforeach
        </select>
        @if(!empty( $errors->first('type')))
          <message class="text-danger">- {{ $errors->first('type') }} </message> 
        @endif
</div>
<div class="form-group">
    <label for="my-input">ร้านค้า</label>
        <select class="form-control {{ !empty( $errors->first('type')) ? 'is-invalid' : '' }}" name="store_id" id="store_id"  >
        <option value="" class="form-control">-เลือกร้านค้า-</option>
        @foreach( $store AS $key => $value )
        @php
            $sel = '';
        @endphp

        @if( !empty($data->store_id) )
            @if($value->id == $data->store_id )
                @php
                    $sel='selected="1"';
                @endphp
            @endif
        @endif
             @if($value->id == old('store_id'))
             @php
                $sel = 'selected="1"';
             @endphp  
         @endif     
         <option class="form-control" {{ $sel }} value="{{ $value->id }}"> {{ $value->name }} </option>
        @endforeach
        </select>
        @if(!empty( $errors->first('store_id')))
          <message class="text-danger">- {{ $errors->first('store_id') }} </message> 
        @endif
</div>      
       
            <div class="form-group">
                <label for="Name">ชื่อสินค้า</label>
                <input type="text" name="name" class="form-control {{ !empty( $errors->first('name')) ? 'is-invalid' : '' }}" value="{{ !empty($data->name) ? $data->name: old('name') }}" >
                @if(!empty( $errors->first('name')))
          <message class="text-danger">- {{ $errors->first('name') }} </message> 
        @endif
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">รายระเอียด</label>
                <textarea rows="5" cols="20" name="detail" class="form-control {{ !empty( $errors->first('detail')) ? 'is-invalid' : '' }}" >{{ !empty($data->detail) ? $data->detail: old('detail') }}</textarea>
                @if(!empty( $errors->first('detail')))
                    <message class="text-danger">- {{ $errors->first('detail') }} </message> 
                 @endif
            </div>
            <div class="form-group">
                <label for="Name">ราคา</label>
                <input type="text" class="form-control {{ !empty( $errors->first('price')) ? 'is-invalid' : '' }}" name="price" value="{{ !empty($data->price) ? $data->price: old('price') }}">
                @if(!empty( $errors->first('price')))
                    <message class="text-danger">- {{ $errors->first('price') }} </message> 
                @endif
            </div>
            <div class="form-group">
                <label for="image">รูป</label>
                <input type="file" name="image" class="form-control" accept="image/*" />
            </div>
            @if(!empty($data->image))
            <div class="text-center">
            <img src="{{asset('storage/'.$data->image)}}" width="250px" height="250px">
            </div>
            @endif
            <div class="button" style="margin-left:400px;">
                <button type="submit" class="btn btn-primary">บันทึก</button>
                <button type="reset" class="btn btn-warning">ล้างมิอ</button>
                <a href="{{ url('product')}}" class="btn btn-danger">ย้อนกลับ</a>
            </div>
        </form>
    </div>
</div>
@endsection
