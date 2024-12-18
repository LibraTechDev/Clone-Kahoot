@extends('user/layout')

@section('content')
<style>
     @keyframes riseUp {
        0% {
            transform: translateY(20px); /* Start from 20px below */
            opacity: 0; /* Start with 0 opacity */
        }
        100% {
            transform: translateY(0); /* End at original position */
            opacity: 1; /* End with full opacity */
        }
    }
    .container-fluid3 {
        animation: riseUp 1s ease-out forwards;
    }
</style>
<div id="loading" class="load">
    <div class="loader"></div>
</div>
<div class="container-fluid3 bg-white rounded-top-5 custom-shadow">
    <div class="row justify-content-center">
        <div class="col-12 text-center">
            <!-- Menampilkan logo -->
            <div class="logos d-flex justify-content-center mt-5">
                <img src=" {{ asset('assets/img/logoUdinus.png') }}" alt="Logo 1" class="mx-2">
                <img src="{{ asset('assets/img/LogoUnggul.png') }}" alt="Logo 2" class="mx-2">
                <img src="{{ asset('assets/img/rankasia.png ') }}" alt="Logo 3" class="mx-2">
            </div>
            <!-- Logo besar di tengah -->
            <div class="d-flex justify-content-center align-items-center mt-0">
            <img src="{{ asset('assets/img/logofikfair.png') }}" alt="Logo Fikfair" class="img-fluid" width="400">
            </div>
    
            <!-- Button Start -->
            <div class="mb-4">
                <a href="/login"><button href="" class="btn btn-welcome btn-lg px-4 py-2">START</button></a>
            </div>
        </div>
    </div>
</div>
<script>
    window.addEventListener('load', function() {
        document.getElementById('loading').style.display = 'none';
    });
</script>

@endsection