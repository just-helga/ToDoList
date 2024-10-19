 @php use Illuminate\Support\Facades\Auth; @endphp
@extends('layout.app')
@section('title')
    Главная
@endsection
@section('content')
    <div id="carouselExampleCaptions" class="carousel  slide" data-bs-ride="false">
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active"
                    aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1"
                    aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2"
                    aria-label="Slide 3"></button>
        </div>
        <div class="carousel-inner">
            <div class="carousel-item  active" style="background-size: cover; height: 90vh">
                <img src="https://www.oum.ru/upload/iblock/ec8/ec8b0cee903a48df80795abdd2d15e08.jpg"
                     class="d-block  w-100  h-100  img-fluid" style="object-fit: cover" alt="">
                <div class="carousel-caption  d-none  d-md-block">
                    @auth()
                        <h1>Привет, {{Auth::user()->fname}}!</h1>
                    @endauth
                    @guest()
                            <h1>Привет, Гость!</h1>
                        @endguest
                </div>
            </div>
            <div class="carousel-item" style="background-size: cover; height: 90vh">
                <img src="https://www.nearbyme2.com/wp-content/uploads/2021/04/How-To-Manage-Your-Time.jpg"
                     class="d-block  w-100  h-100  img-fluid" style="object-fit: cover" alt="">
                <div class="carousel-caption  d-none  d-md-block">
                    @auth()
                        <h1>Привет, {{Auth::user()->fname}}!</h1>
                    @endauth
                    @guest()
                        <h1>Привет, Гость!</h1>
                    @endguest
                </div>
            </div>
            <div class="carousel-item" style="background-size: cover; height: 90vh">
                <img
                    src="https://amgtime.com/blog/wp-content/uploads/2019/05/How-to-Build-Smart-Time-Management-105.06.2020.jpg.jpg"
                    class="d-block  w-100  h-100  img-fluid" style="object-fit: cover" alt="">
                <div class="carousel-caption  d-none  d-md-block">
                    @auth()
                        <h1>Привет, {{Auth::user()->fname}}!</h1>
                    @endauth
                    @guest()
                        <h1>Привет, Гость!</h1>
                    @endguest
                </div>
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions"
                data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions"
                data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
@endsection
