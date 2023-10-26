@extends('layouts.app')
@section('content')
    <div class="container">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mt-4 mb-0 text-gray-800">Quản lý tour</h1>
        </div>

        @if (session('message'))
            <div class="alert alert-info alert-dismissible fade show" role="alert">
                <strong>{{ session('message') }}</strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th>STT</th>
                            <th>Tên</th>
                            <th>Tên Tour</th>
                            <th>Ngày khởi hành</th>
                            <th>Địa chỉ đón</th>
                            <th>Số người</th>
                            <th>Tổng tiền</th>
                            <th>SĐT</th>
                            <th>Trạng Thái</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($orders as $key => $order)
                            <tr>
                                <td>{{ $order->id }}</td>
                                <td>{{ $users[$key]->name }}</td>
                                <td>{{ $tourNames[$key]->name }}</td>
                                <td>{{ $order->date }}</td>
                                <td>{{ $order->address }}</td>
                                <td>{{ $order->number }}</td>
                                <td>{{number_format($order->totalPrice)}}</td>
                                <td>{{ $order->phone }}</td>
                                <td>
                                    @if ($order->status === 2)
                                    Đã xác nhận
                                    @else
                                    Chờ xác nhận
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center">Data Empty</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

    </div>
@endsection
