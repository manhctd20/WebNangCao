@extends('layouts.app')

@section('content')
    <main class="container mb-5 mt-5">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card p-4">

                    @if ($errors->any())
                    <div class="alert alert-danger" role="alert">
                        <ul>
                            @foreach ($errors->all() as $error)
                            <li>{{$error}}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif
                    <form action="{{ route('admin.user.update', [auth()->id()] ) }}" method="POST" enctype="multipart/form-data">
                        @method("PUT")
                        @csrf
                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" name="name" class="form-control"value="{{ $user->name }}" id="name">
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Email</label>
                            <input type="email" name="email" class="form-control"value="{{ $user->email }}" id="exampleInputEmail1">
                        </div>
                        <div class="mb-3">
                            <label for="phone" class="form-label">Phone</label>
                            <input type="text" name="phone" class="form-control"value="{{ $user->phone }}" id="phone">
                        </div>
                        <div class="mb-3">
                            <label for="address" class="form-label">Địa chỉ</label>
                            <input type="text" name="address" class="form-control"value="{{ $user->address }}" id="address">
                        </div>
                        <button type="submit" class="btn btn-contact">Thay đổi</button>
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#myModal">Thay đổi mật khẩu</button>
                    </form>
                </div>
            </div>
            <div class="modal" id="myModal">
                <div class="modal-dialog">
                  <div class="modal-content">

                    <!-- Modal Header -->
                    <div class="modal-header">
                      <h4 class="modal-title">Thay đổi mật khẩu</h4>
                      <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>

                    <!-- Modal body -->
                    <div class="modal-body">
                        <form action="{{route('change-password') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <label for="old-password" class="form-label">Old Password</label>
                                <input type="password" name="current_password" class="form-control" id="old-password" placeholder="Nhập mật khẩu cũ">
                            </div>
                            <div class="mb-3">
                                <label for="new-password" class="form-label">New Password</label>
                                <input type="password" name="new_password" class="form-control" id="new-password" placeholder="Nhập mật khẩu mới">
                            </div>
                            <div class="mb-3">
                                <label for="confirm-password" class="form-label">Confirm Password</label>
                                <input type="password" name="new_password_confirmation" class="form-control" id="confirm-password"  placeholder="Xác nhận mật khẩu mới">
                            </div>
                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary" data-bs-dismiss="modal">Xác nhận</button>
                        </form>
                    </div>
                  </div>
                </div>
            </div>

        </div>
    </main>
@endsection
