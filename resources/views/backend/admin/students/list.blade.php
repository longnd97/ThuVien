@extends('backend.layouts.master')
@section('title','Danh sách sinh viên')
@section('content')
    <h1 class="mt-4">Danh sách sinh viên</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="{{route('home.index')}}">Trang chủ</a></li>
        <li class="breadcrumb-item active">Danh sách sinh viên</li>
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
                <a class="btn btn-success" href="{{ route('students.create') }}">Thêm mới</a>
            </h3>
        </div>
        <div class="card-header">
            <i class="fas fa-table me-1"></i>
            Danh sách sinh viên
        </div>
        <div class="card-body">
            <table id="datatablesSimple">
                <thead>
                <tr>
                    <th>STT</th>
                    <th>Ảnh</th>
                    <th>Tên sinh viên</th>
                    <th>Mã sinh viên</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                @foreach($students as $key=>$student)
                    <tr>
                        <td>{{++$key}}</td>
                        <td style="width: 150px"> @if($student->image)
                                <img src="{{ asset('storage/'.$student->image) }}" alt=""
                                     style="width: 100%">
                            @else
                                {{'Chưa có ảnh'}}
                            @endif</td>
                        <td>{{$student->name}}</td>
                        <td>{{$student->student_code}}</td>
                        {{--                        <td>--}}
                        {{--                            <a href="" class="btn btn-success">--}}
                        {{--                                <i class="fas fa-eye"></i>--}}
                        {{--                            </a>--}}
                        {{--                            <a href="{{route('students.edit',['id'=>$student->id])}}" class="btn btn-primary">--}}
                        {{--                                <i class="fas fa-edit"></i>--}}
                        {{--                            </a>--}}
                        {{--                            <a href="{{route('students.destroy',['id'=>$student->id])}}"--}}
                        {{--                               onclick="return confirm('Bạn muốn xóa sách này?')"--}}
                        {{--                               class="btn btn-danger">--}}
                        {{--                                <i class="fas fa-trash"></i>--}}
                        {{--                            </a>--}}
                        {{--                        </td>--}}
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
