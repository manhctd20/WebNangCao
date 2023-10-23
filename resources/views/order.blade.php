@extends('layouts.app')

@section('content')
<main class="container mt-5 mb-5 ">
  <div class="row justify-content-center">
      <div class="col-lg-8">
          <div class="card p-4">

            @if(session('message'))
              <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>{{ session('message') }}</strong>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>
            @endif

            <h1>Đặt tour</h1>
              <form action="" method="POST" enctype="multipart/form-data">
                  @csrf
                  <div class="form-group mb-3">
                      <label for="tour">Tour</label>
                      <select class="form-control" id="tour" disabled>
                          <option>Tour 1</option>
                      </select>
                  </div>
                  <div class="form-group mb-3">
                      <label for="number">Số người tham gia:</label>
                      <input type="number" class="form-control" id="number" name="number" placeholder="Nhập số người tham gia">
                  </div>
                  <div class="form-group mb-3">
                      <label for="address">Địa điểm đón:</label>
                      <input type="text" class="form-control" id="address" name="address" placeholder="Nhập địa chỉ đón">
                  </div>
                  <div class="form-group mb-3">
                      <label for="date">Ngày bắt đầu:</label>
                      <input type="date" class="form-control" id="date" name="date" placeholder="Nhập họ và tên">
                  </div>
                  <!-- Thêm các trường thông tin khác -->
                  <button type="submit" class="btn btn-primary">Xác nhận</button>
              </form>

          </div>
      </div>
  </div>
</main>
@endsection