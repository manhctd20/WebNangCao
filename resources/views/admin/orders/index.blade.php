@extends('admin.layout')

@section('content')
    <div class="container">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Manage Orders</h1>
            {{-- <a href="{{ route('admin.cars.create') }}" class="btn btn-primary btn-sm shadow-sm">Add Car <i class="fa fa-plus"> </i></a> --}}
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
                            <th>ID</th>
                            <th>User Name</th>
                            <th>Travel Tour Name</th>
                            <th>Date</th>
                            <th>Address</th>
                            <th>People</th>
                            <th>Total Price</th>
                            <th>Phone</th>
                            <th>status</th>
                            <th>Action</th>
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
                                <td>{{ number_format($order->totalPrice) }}</td>
                                <td>{{ $order->phone }}</td>
                                <td>
                                    @if ($order->status === 2)
                                    Đã xác nhận
                                    @else
                                    Chờ xác nhận
                                    @endif
                                </td>
                                <td>
                                    <form class="d-inline" action="{{route('orders.update',[$order->id])}}"
                                        method="POST">
                                        @method("PUT")
                                        @csrf
                                        @if ($order->status !== 2)
                                        <input type="hidden" name="status" value="2">
                                        <button onClick="return confirm('Are you sure !')" class="btn btn-primary">
                                            <i class="fa fa-check"></i>
                                        </button>
                                        @endif
                                    </form>
                                    <form class="d-inline" action="{{route('orders.update',[$order->id])}}"
                                        method="POST">
                                        @method("DELETE")
                                        @csrf
                                        <button onClick="return confirm('Are you sure !')" class="btn btn-danger">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                    </form>
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


        <!-- Content Row -->

    </div>
@endsection
