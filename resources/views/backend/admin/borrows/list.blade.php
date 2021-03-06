@extends('backend.layouts.master')
@section('title','Danh sách phiếu mượn')
@section('content')
    <h1 class="mt-4">Danh sách phiếu mượn</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="{{route('home.index')}}">Trang chủ</a></li>
        <li class="breadcrumb-item active">Danh sách phiếu mượn</li>
    </ol>
    @if (Session::has('success'))
        <p class="text-success">
            <i class="fa fa-check" aria-hidden="true"></i>
            {{ Session::get('success') }}
        </p>
    @endif
    <div class="card mb-4">
        <div class="card-header">
            <h3 class="card-title">
                <a class="btn btn-success" href="{{ route('borrows.create') }}">Thêm mới</a>
            </h3>
        </div>
        <div class="card-header">
            <i class="fas fa-table me-1"></i>
            Danh sách phiếu mượn
        </div>
        <div class="card-body">
            <table id="datatablesSimple">
                <thead>
                <tr>
                    <th>Mã phiếu mượn</th>
                    <th>Sinh viên mượn</th>
                    <th>Ngày mượn</th>
                    <th>Ngày trả</th>
                    <th>Trạng thái</th>
                    <th>Xác nhận đã trả</th>
                </tr>
                </thead>
                <tbody>@foreach($borrows as $key=>$borrow)
                    @if($borrow->status==\App\Http\Controllers\BorrowConstant::BORROWED)
                        <tr>
                            <td>@if($key<10) {{'PM00'.++$key}}
                                @else {{'PM0'.++$key}}
                                @endif
                            </td>
                            <td>{{$borrow->student->name}}</td>
                            <td>{{date('d-m-Y',strtotime($borrow->borrow_date))}}</td>
                            <td>{{date('d-m-Y',strtotime($borrow->return_date))}}</td>
                            <td class="text-success"><i class="fas fa-circle"></i>Đang mượn</td>
                            <td><a data-id="{{$borrow->id}}" class="confirm-return btn btn-success"
                                   style="margin-left: 50px">
                                    <i class="fas fa-check"></i>
                                </a></td>
                        </tr>
                    @endif
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
