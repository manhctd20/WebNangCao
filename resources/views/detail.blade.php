@extends('layouts.app')

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


<style>
    .review {
        /* border: 1px solid #ccc; */
        padding: 10px;
        margin-bottom: 20px;
        border-radius: 5px;
        background-color: #fff;
        /* box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1); */
    }

    .review h5 {
        font-size: 18px;
        margin-bottom: 10px;
        font-weight: bold;
    }

    .review .user-info {
        font-weight: bold;
        margin-bottom: 5px;
    }

    .review .rating {
        display: flex;
        justify-items: center;
        align-items: center;
        color: orange;
        margin-bottom: 10px;
    }

    .review .comment {
        font-size: 16px;
    }

    .review-form {
        background-color: #f9f9f9;
        border: 1px solid #e7e3e3;
        border-radius: 5px;
        /* box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1); */
        padding: 20px;
        margin-bottom: 20px;
    }

    .review-form h3 {
        font-size: 24px;
        margin-bottom: 20px;
        font-weight: bold;
    }

    .review-form label {
        font-weight: bold;
        margin-top: 10px;
    }

    .review-form select,
    .review-form textarea {
        width: 100%;
        padding: 10px;
        margin: 5px 0;
        border: 1px solid #ccc;
        border-radius: 5px;
    }

    .review-form button {
        background-color: #007BFF;
        color: #fff;
        padding: 10px 20px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        transition: background-color 0.3s;
    }

    .review-form button:hover {
        background-color: #0056b3;
    }

    .star {
        display: none;
    }

    .star+label {
        font-size: 30px;
        cursor: pointer;
    }

    .star:checked+label,
    .star:hover+label {
        color: orange;
    }

    .star:not(:checked)+label:hover~label {
        color: black;
    }

    .rating {
        display: inline-block;
        margin-top: 10px;
    }

    .rating input {
        display: none;
    }

    .rating label {
        cursor: pointer;
        width: 25px;
        height: 25px;
        margin-right: 5px;
        background-image: url('{{ asset('frontend/assets/images/stars/star-empty.png') }}');
        background-size: cover;
    }

    .rating input:checked+label {
        background-image: url('{{ asset('frontend/assets/images/stars/star-fill.png') }}');
    }

    .swiper-3d .swiper-slide-shadow-left{
        width: initial !important;
        height: initial !important;
    }
    .swiper-3d .swiper-slide-shadow-right{
        width: initial !important;
        height: initial !important;
    }
    .swiper-wrapper {
        height: initial !important;
    }
</style>
<script>
    $(document).ready(function() {
        var expanded = false;

        $('.review').each(function(index) {
            if (index > 2) {
                $(this).hide();
            }
        });

        if ($('.review').length <= 3) {
            $('#showMoreButton').hide();
        }

        // Xử lý khi nhấn vào nút 'Xem thêm'
        $('#showMoreButton').on('click', function() {
            $('.review').each(function(index) {
                if (index > 2) {
                    if (expanded) {
                        $(this).hide();
                    } else {
                        $(this).show();
                    }
                }
            });

            if (expanded) {
                $(this).text('Xem thêm');
            } else {
                $(this).text('Rút gọn');
            }
            expanded = !expanded;
        });
    });


    $(document).ready(function() {
        $('#submitReviewButton').click(function(e) {
                e.preventDefault(); // Ngăn chặn form được gửi đi

                @auth
                $('form').submit();
            @else
                alert('Vui lòng đăng nhập để gửi đánh giá.');
                $('#loginLink')[0].click();
            @endauth
        });
    });
    document.addEventListener("DOMContentLoaded", function() {
        const ratingInputs = document.querySelectorAll('.star');
        const labels = document.querySelectorAll('.rating label');
        let selectedRating = 0;

        labels.forEach((label, index) => {
            label.addEventListener('mouseover', () => {
                selectedRating = index + 1;
                setRating(selectedRating);
            });

            // label.addEventListener('click', () => {
            //     alert(`Đánh giá của bạn là: ${selectedRating} sao`);
            // });

            label.addEventListener('mouseout', () => {
                setRating(selectedRating);
            });
        });

        function setRating(rating) {
            ratingInputs.forEach((starInput, index) => {
                if (index < rating) {
                    starInput.checked = true;
                } else {
                    starInput.checked = false;
                }
            });
        }
    });
</script>

@section('content')
    <main>
        @if (session('message'))
            <div class="alert alert-info alert-dismissible fade show my-custom-alert" role="alert" id="myAlert">
                <strong>{{ session('message') }}</strong>
                <button type="button" class="close custom-close-button" data-dismiss="alert" aria-label="Close" id="closeAlert">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                document.getElementById('closeAlert').addEventListener('click', function() {
                    document.getElementById('myAlert').style.display = 'none';
                });
            });
        </script>

        <section class="container mt-5" style="margin-bottom: 70px">
            <div class="col-12 col-md">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a class="title-alt" href="{{ route('home') }}">Trang Chủ</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a class="title-alt" href="{{ route('package') }}">Tour Du Lịch</a>
                        </li>
                        <li class="breadcrumb-item main-color">Chi tiết Tour</li>
                    </ol>
                </nav>
            </div>

            <div class="col-12 col-md text-center">
                <h1 class="main-color">{{ $travelPackage->name }}</h1>
                <span class="title-alt">{{ $travelPackage->location }}</span>
            </div>
        </section>

        <!--=============== Package Travel ===============-->
        <section class="container detail">
            <div class="swiper mySwiper detail-container">
                <div class="swiper-wrapper">

                    @foreach ($travelPackage->galleries as $gallery)
                        <div class="detail-card swiper-slide">
                            <img src="{{ Storage::url($gallery->path) }}" alt="" class="detail-img" />
                        </div>
                    @endforeach

                </div>
            </div>

            <div class="row" style="margin-top: 120px">
                <div class="col-12 col-md-12 col-lg-6">
                    <div class="card border-0 " style="padding: 30px 40px">
                        <h4 class="fw-bolder title text-center">Mô tả</h4>
                        {!! $travelPackage->description !!}
                    </div>
                </div>
                <div class="col-12 col-md-12 col-lg-6">
                    <div class="card border-0 card-form" style="padding: 30px 40px">
                        <h4 class="fw-bolder title text-center">Đặt vé</h4>
                        <div class="alert alert-secondary" style="background-color: #f5f5f5; border: 1px solid #f5f5f5"
                            role="alert">
                            Thời gian: {{ $travelPackage->duration }}
                        </div>
                        <div class="alert alert-secondary" style="background-color: #f5f5f5; border: 1px solid #f5f5f5"
                            role="alert">
                            Giá tiền:
                            <span class="text-gray-500 font-weight-light">{{ number_format($travelPackage->price) }}
                                vnđ</span>
                        </div>
                        @if (Auth::check())
                            <a onClick="return confirm('Bạn chắc chắn muốn đặt tour?')"
                                href="{{ route('order', ['tour_id' => $travelPackage->id]) }}"
                                class="btn btn-book btn-block mt-3" id="continue">Tiếp tục
                            </a>
                        @else
                            <p>Bạn cần đăng nhập để tiếp tục đặt tour.</p>
                            <a href="{{ route('login') }}" class="btn btn-primary">Đăng nhập</a>
                        @endif

                    </div>
                </div>
                <div class="row" style="margin-top: 120px">
                    <div class="col-12 col-md-12 col-lg-12">
                        <div class="review-form">
                            <h3 class="fw-bold">Đánh Giá</h3>
                            <form action="{{ route('review.store') }}" method="POST">
                                @csrf
                                <input type="hidden" name="user_id" value="{{ auth()->id() }}">
                                <input type="hidden" name="travel_package_id" value="{{ $travelPackage->id }}">
                                <label for="rating"></label>
                                <div class="rating">
                                    <input class="star" type="checkbox" id="star1" name="rating" value="1">
                                    <label for="star1"></label>
                                    <input class="star" type="checkbox" id="star2" name="rating" value="2">
                                    <label for="star2"></label>
                                    <input class="star" type="checkbox" id="star3" name="rating" value="3">
                                    <label for="star3"></label>
                                    <input class="star" type="checkbox" id="star4" name="rating" value="4">
                                    <label for="star4"></label>
                                    <input class="star" type="checkbox" id="star5" name="rating" value="5">
                                    <label for="star5"></label>
                                </div>
                                <div class="mb-3">
                                    <label for="comment" class="fw-bold">Bình luận:</label>
                                    <textarea class="form-control" name="comment" rows="4"></textarea>
                                </div>
                                <button type="submit" id="submitReviewButton" class="btn btn-primary">
                                    Gửi Đánh giá</button>
                            </form>
                        </div>

                        <div class="review-list">

                            @foreach ($reviews as $key => $review)
                                <div class="review">
                                    <p class="user-info">Người dùng: {{ $users[$key]->name }}</p>
                                    <div class="rating">
                                        {{ $review->rating }}
                                        <img width="20"
                                            src="{{ asset('frontend/assets/images/stars/star-fill.png') }}"
                                            alt="">
                                    </div>
                                    <p class="comment">{{ $review->comment }}</p>
                                    <p class="created_at">{{ $review->created_at }}</p>
                                </div>
                            @endforeach


                            <button id="showMoreButton" class="btn btn-primary mt-3">Xem thêm</button>

                        </div>
                    </div>
                </div>

            </div>

        </section>
    </main>
@endsection

@push('style-alt')
    <link rel="stylesheet" href="{{ asset('frontend/assets/libraries/swipper/css/style.css') }}">
    <style>
        .swiper-container-3d .swiper-slide-shadow-left,
        .swiper-container-3d .swiper-slide-shadow-right {
            background-image: none;
        }

        figure {
            overflow-x: auto;
            -webkit-overflow-scrolling: touch;
        }

        figure table {
            --bs-table-bg: transparent;
            --bs-table-accent-bg: transparent;
            --bs-table-striped-color: #212529;
            --bs-table-striped-bg: rgba(0, 0, 0, 0.05);
            --bs-table-active-color: #212529;
            --bs-table-active-bg: rgba(0, 0, 0, 0.1);
            --bs-table-hover-color: #212529;
            --bs-table-hover-bg: rgba(0, 0, 0, 0.075);
            width: 100%;
            margin-bottom: 1rem;
            color: #212529;
            vertical-align: top;
            border-color: #dee2e6;
        }

        tbody,
        td,
        tfoot,
        th,
        thead,
        tr {
            border-color: inherit;
            border-style: solid;
        }

        table>:not(caption)>*>* {
            border: 1px solid #dee2e6;
        }

        table>:not(caption)>*>* {
            padding: 0.5rem 0.5rem;
            background-color: transparent;
            border-bottom-width: 1px;
            box-shadow: inset 0 0 0 9999px transparent;
        }
    </style>
@endpush

@push('script-alt')
    <script src="{{ asset('frontend/assets/libraries/swipper/js/app.js') }}"></script>
    <script>
        var swiper = new Swiper(".mySwiper", {
            effect: "coverflow",
            grabCursor: true,
            centeredSlides: true,
            slidesPerView: "auto",
            loop: true,
            spaceBetween: 32,
            coverflowEffect: {
                rotate: 0,
            },
        });
    </script>
@endpush
