@extends('user/layout') 

@section('content')
<div class="login">
    <div class="logo-container">
        <img src="{{ asset('assets/img/logofikfair5.png') }}" alt="Logo Fikfair" class="img-fluid" />
    </div>
    <div class="container-fluid bg-white rounded-top-5 custom-shadow">
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
                        <form>
                            <div class="mb-3">
                                <select id="schoolName" class="form-select">
                                    <option selected disabled>
                                        Pilih Nama Sekolah
                                    </option>
                                    <option value="1">Sekolah 1</option>
                                    <option value="2">Sekolah 2</option>
                                    <option value="3">Sekolah 3</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <input
                                    type="text"
                                    id="name"
                                    class="form-control"
                                    placeholder="Masukkan Nama"
                                />
                            </div>
                        </form>
                        <a href="">
                            <button class="btn button btn-welcome btn-lg px-4 py-2 mt-5 text-center">
                            START
                        </button>
                    </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
