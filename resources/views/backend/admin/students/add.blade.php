@extends('backend.layouts.master')
@section('title','Thêm mới sinh viên')
@section('content')
    <h1 class="mt-4">Thêm mới sinh viên</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="{{route('home.index')}}">Trang chủ</a></li>
        <li class="breadcrumb-item active"><a href="{{route('borrows.index')}}">Danh sách sinh viên</a>
        </li>
        <li class="breadcrumb-item active">Thêm mới sinh viên</li>
    </ol>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <p class="card-title">Thêm mới sinh viên</p>
                    </div>
                    <form action="">
    @csrf

@endsection
