@extends('user/layout') 

@section('content')
<!-- Image above container-fluid3 -->
<div id="loading" class="load">
    <div class="loader"></div>
</div>
<div class="logo-container">
    <img src="{{ asset('assets/img/logofikfair5.png') }}" alt="Your Image" class="img-fluid" width="400">
</div>

<div class="container-fluid3 bg-white rounded-top-5 custom-shadow">
    <div class="row justify-content-center">
        <div class="col-12 text-center">
            <div class="title d-flex justify-content-center mt-5">
                Welcome to FIK School Competition
            </div>
            <div class="d-flex justify-content-center align-items-center mt-0">
                <img
                    src="{{ asset('assets/img/Illustration.png ') }}"
                    alt="Logo Fikfair"
                    class="img-fluid"
                    width="200"
                />
            </div>
            <div class="mb-4">
                <div class="container mt-5">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="mb-3">
                            <input
                                type="text"
                                id="name"
                                class="form-control"
                                placeholder="Masukkan Nama"
                                name="name" 
                            />
                        </div>
                        <input
                        type="hidden"
                        id="registration_date"
                        class="form-control"
                        placeholder="Masukkan Nama"
                        name="registration_date" 
                        value="{{ now()->format('Y-m-d') }}"
                        />

                        <div class="mb-3">
                            <div class="input-group">
                                <input type="password" 
                                        name="password" 
                                        id="password"
                                        class="form-control"
                                        placeholder="Masukkan Password">
                        
                            </div>
                        </div>
                        
                        <button class="btn button btn-welcome btn-lg px-4 py-2 mt-5 text-center">
                            {{ __('Log in') }}
                        </button>
                        <p class="mb-5 mt-5 pb-lg-2" style="color:#a5c8e6; font-weight: bold;">Belum Punya Akun?  <a href="{{route('user.register')}}"
                            style="color: black; font-weight: normal;">Daftar disini</a></p>
                    </form>
                </div>
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
