@extends('layouts.app')

@section('content')
<div class="container">
<a href="{{ url('store/store/create') }}" class="btn btn-success float-right"><i class="fa fa-plus"></i> เพิ่มข้อมูลสมาชิก</a>
<table class="table table-striped">
  <thead class="text-center">
    <tr>
      <th scope="col">ลำดับ</th>
      <th scope="col">ชื่อ</th>
        <th scope="col">ที่อยู่</th>
      <th scope="col">รูป</th>
      <th scope="col">จัดการ</th>
    </tr>
  </thead>
  <tbody>
  @php
    $Number = 0;
    $start = 1;
    $end = $limit < count($data) ? $limit : count($data);
    @endphp
    @if( $data->currentPage() > 1)
      @php
      $Number = $limit * ($data->currentPage() - 1);
      $start = $limit * ($data->currentPage()-1) + 1;
      $end = $start + ($limit-1);
      @endphp

      @if( $end >= $data->total())
        @php
          $end = $data->total();
        @endphp
        @endif
      @endif
  @foreach( $data as $key => $value )
    <tr>
      <th class="text-center">{{ $Number + $loop->iteration }}</th>
      <td class="text-center">{{ $value->name }}</td>
      <td class="text-center">{{ $value->address }}</td>
      <td class="text-center">
      @if(!empty($value->logo))
            <div class="text-center">
            <img src="{{asset('storage/'.$value->logo)}}" width="80px" height="80px">
            </div>
            @else
            <div class="text-center">
            <img src="{{asset('storage/photos/Noimg.jpg')}}" width="80px" height="80px">
            @endif 
      </td>
      <td class="text-center">
        <a href="{{ action('StoreController@edit', $value->id) }}" class="btn btn-warning"><i class="fa fa-edit"></i> แก้ไข</a>
        <a href="" onclick="return confirm('ลบ ?')" class="btn btn-danger"><i class="fa fa-trash"></i> ลบ</a>
      </td>
    </tr>
    @endforeach
  </tbody>
  <tfoot class="table table-striped">
   
      </div>
    </th> 
    </tr>
  </tfoot>
</table>
</div>
@endsection
