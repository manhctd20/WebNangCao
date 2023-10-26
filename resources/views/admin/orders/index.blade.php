@extends('admin.layout')

@section('content')
    <div class="container">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Manage User</h1>
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
                            <th>User_Id</th>
                            <th>Travel_Package_Id</th>
                            <th>Date</th>
                            <th>Address</th>
                            <th>People</th>
                            <th>Total Price</th>
                            <th>Phone</th>
                            {{-- <th>Action</th> --}}
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($orders as $order)
                            <tr>
                                <td>{{ $order->id }}</td>
                                <td>{{ $order->user_id }}</td>
                                <td>{{ $order->travel_package_id }}</td>
                                <td>{{ $order->date }}</td>
                                <td>{{ $order->address }}</td>
                                <td>{{ $order->number }}</td>
                                <td>{{ $order->totalPrice }}</td>
                                <td>{{ $order->phone }}</td>
                                {{-- <td>
                                    <a href="{{ route('admin.orders.edit', $order) }}" class="btn btn-info">
                                        <i class="fa fa-pencil-alt"></i>
                                    </a>
                                    <form class="d-inline" action="{{ route('admin.orders.destroy', $order) }}"
                                        method="POST">
                                        @csrf
                                        @method('delete')
                                        <button onClick="return confirm('Are you sure !')" class="btn btn-danger">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                    </form>
                                </td> --}}
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
