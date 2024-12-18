@extends('user/layout') 

@section('content')
<!-- Image above container-fluid3 -->
<div id="loading" class="load">
    <div class="loader"></div>
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
                    <form method="POST" action="{{ route('register') }}">
                        @csrf
                        <div class="mb-3">
                            <select name="school" id="school" class="form-select">
                                <option selected disabled>
                                    Pilih Nama Sekolah
                                </option>
                                @foreach($schools as $school)
                                    <option value="{{ $school->id }}">{{ $school->school }}</option>
                                @endforeach
                            </select>
                        </div>
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
                        <div class="mb-3">
                            <div class="input-group">
                                <input type="password" 
                                        name="password_confirmation" 
                                        id="password_confirmation"
                                        class="form-control"
                                        placeholder="Masukkan Ulang Password">
                        
                            </div>
                        </div>
                        
                        <button class="btn button btn-welcome btn-lg px-4 py-2 mt-5 text-center">
                            {{ __('Register') }}
                        </button>
                    
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
