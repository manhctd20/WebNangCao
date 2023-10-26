@extends('admin.layout')

@section('content')
    <div class="container">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Manage Reviews</h1>
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
                            <th>Rating</th>
                            <th>Comment</th>
                            <th>Created_At</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($reviews as $key => $review)
                            <tr>
                                <td>{{ $review->id }}</td>
                                <td>{{ $users[$key]->name }}</td>
                                <td>{{ $tourNames[$key]->name }}</td>
                                <td>{{ $review->rating }}</td>
                                <td>{{ $review->comment }}</td>
                                <td>{{ $review->created_at }}</td>
                                <td>
                                    <a href="{{ route('admin.reviews.edit', $review) }}" class="btn btn-info">
                                        <i class="fa fa-check"></i>
                                    </a>
                                    <form class="d-inline" action="{{ route('admin.reviews.destroy', $review) }}"
                                        method="POST">
                                        @csrf
                                        @method('delete')
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
