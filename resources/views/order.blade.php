<script>
    function updateTotalPrice() {
        var number = document.getElementById('number').value;
        var option = document.getElementById('tour').options[document.getElementById('tour').selectedIndex];
        var price = parseFloat(option.getAttribute('data-price'));
        var totalPrice = number * price;
        document.getElementById('totalPrice').value = totalPrice;
        document.getElementById('totalPriceDisplay').textContent = totalPrice;
    }
</script>

@extends('layouts.app')

@section('content')


    <main class="container mt-5 mb-5 ">
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

                  <h1>Đặt tour</h1>
                    <form action="{{ route('orders.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="user_id" value="{{ auth()->id() }}">
                        <div class="form-group mb-3">
                            <label for="tour">Tour</label>
                            <select class="form-control" name="travel_package_id" id="tour">
                                @foreach($travels as $travel)
                                    <option value="{{ $travel->id }}" {{ $tourId == $travel->id ? 'selected' : '' }} data-price="{{ $travel->price }}">
                                        {{ $travel->name }} -- ${{ $travel->price }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group mb-3">
                            <label for="phone">Số điện thoại:</label>
                            <input type="number" class="form-control" id="phone" name="phone" value="{{ old('phone') }}" placeholder="Nhập số người tham gia" onchange="updateTotalPrice()">
                        </div>
                        <div class="form-group mb-3">
                            <label for="number">Số người tham gia:</label>
                            <input type="number" class="form-control" id="number" name="number" value="{{ old('number') }}" placeholder="Nhập số người tham gia" onchange="updateTotalPrice()">
                        </div>
                        <div class="form-group mb-3">
                            <label for="address">Địa điểm đón:</label>
                            <input type="text" class="form-control" id="address" name="address" value="{{ old('address') }}" placeholder="Nhập địa chỉ đón">
                        </div>
                        <div class="form-group mb-3">
                            <label for="date">Ngày bắt đầu:</label>
                            <input type="date" class="form-control" id="date" name="date" value="{{ old('date') }}" placeholder="Nhập họ và tên">
                        </div>
                        <input type="hidden" name="totalPrice" id="totalPrice" value="{{ old('totalPrice') }}">
                        <div class="mb-3">Tổng: <span id="totalPriceDisplay"></span>VNĐ</div>
                        <!-- Thêm các trường thông tin khác -->
                        <button type="submit" class="btn btn-primary">Xác nhận</button>
                    </form>

                </div>
            </div>
        </div>
    </main>
@endsection


