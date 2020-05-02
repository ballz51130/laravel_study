@extends('layouts.app')
@section('content')
<div class="container">
    <div class="table">
    <div class="clearfix mb-2">
        <div class="float-left">
            <form method="GET" class="form-inline">
            <div class="form-group">
                <label for="limit" class="sr-only">Limit</label>
                <select name="limit" class="form-control" id="limit">
                    @php
                        $limits = [5, 10, 15, 20];
                    @endphp
                    @for($i=0; $i < count($limits); $i++ )
                        @php
                            $sel = $limits[$i] == $limit ? 'select="1"' : '';
                        @endphp
                    <option {{ $sel }} value="{{ $limits[$i] }}">{{ $limits[$i] }}</option>
                    @endfor
                </select>
            </div>
                <div class="form-group">
                    <label for="search" class="sr-only">Search</label>
                    <input type="text" class="form-control" id="search" name="search" placeholder="ค้นหา ชื่อสินค้า" value="{{ !empty($_GET['search']) ? $_GET['search'] : '' }}">
                </div>
                <button type="submit" class="btn btn-success"><i class="fa fa-search"></i></button>
            </form>
        </div>
        <a href="{{ url('type/create') }}" class="btn btn-primary float-right">เพิ่มข้อมูล</a>
    </div>
        <table class="table table-striped table-bordered">
            <thead class="thead-dark">
                <tr style="text-align:center;">
                    <th scope="col">#</th>
                    <th scope="col">ชื่อสินค้า</th>
                    <th scope="col"></th>
                </tr>
            </thead>
            <tbody>
                @php
                    $Number = 0;
                    $first = 1 ;
                    $last = $limit < count($data) ? $limit : count($data); 
                @endphp 

                @if( $data->currentPage() > 1)
                    @php
                        $Number = $limit * ($data->currentPage() - 1);
                        $first = $limit * ($data->currentPage()-1) + 1;
                        $last = $first + ($limit-1);
                    @endphp
                    
                @if( $last >= $data->total())
                    @php
                        $last = $data->total();
                    @endphp

                @endif
                    
                @endif

                    @foreach($data as $key => $value)
                    <tr>
                        <th align="center">{{ $Number + $loop->iteration}}</th>
                        <td align="center">{{ $value->name }}</td>
                        <td align="center"><a href="{{ action('ProductTypeController@edit',$value->id) }}"
                                class="btn btn-secondary">แก้ไข</a>
                            <a href="{{ action('ProductTypeController@delete',$value->id) }}" class="btn btn-danger"
                                onclick="return confirm('ลบเหอะ')"> ลบ </a>
                        </td>
                    </tr>
                    @endforeach
            </tbody>
            <tfoot class="table-dark">
                <tr>
                    <th colpan="5">แสดงข้อมูลจำนวน {{ $first }} ถึง {{ $last }} จาก {{$data->total()}} รายการ </th>
                </tr>
            </tfoot>
        </table>
        {{ $data->appends(request()->query())->links() }}
        
    </div>

</div>
@endsection
