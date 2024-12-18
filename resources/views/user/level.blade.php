@extends('user.layout')

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
        @keyframes riseDown {
            0% {
                transform: translateY(0); /* Start from 20px below */
                opacity: 0; /* Start with 0 opacity */
            }
            100% {
                transform: translateY(20px); /* End at original position */
                opacity: 1; /* End with full opacity */
            }
        }

        /* Apply animation to the button */
        .btn-start2 {
            animation: riseUp 0.5s ease-out forwards; /* Animation duration: 0.5s, easing function */
        }

        .container-fluid {
            animation: riseUp 1s ease-out forwards;
        }
        .logo-container{
            animation: riseDown 1s ease-out forwards;
        }
        .floating-menu {
            animation: riseUp 1s ease-out forwards;
        }
        .number-anim {
            font-weight: bold;
            animation: countUp 2s ease-out forwards;
        }

        @keyframes countUp {
            0% {
                opacity: 0;
            }
            100% {
                opacity: 1;
            }
        }
    </style>

    @if(session('success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: '{{ session('success') }}',
                timer: 3000,
                showConfirmButton: false
            });
        </script>
    @endif

    @if($errors->any())
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Error!',
                text: '{{ $errors->first() }}',
                timer: 3000,
                showConfirmButton: false
            });
        </script>
    @endif
    <!-- Logo Fikfair -->

    <div class="logo-container">
        <img src="{{ asset('assets/img/logofikfair5.png') }}" alt="Logo Fikfair" class="img-fluid" />
    </div>
    <!-- Main Content -->
    <div class="container-fluid bg-white rounded-top-5 custom-shadow">
        <div class="row justify-content-center">
            <div class="col-12 text-center pilih-babak">
                <!-- Menampilkan "Hi <user.name>" -->
                @auth
                    <h3 class="mt-1">Hi, {{ Auth::user()->name }}!</h3>
                    <h3 class="mt-1 mb-5">Pilih Babak !!!</h3>

                @else
                    <h3 class="mt-1 mb-5">Guest</h3>
                @endauth
            </div>

            <div class="col-12 text-center mb-4 d-flex flex-column justify-content-center align-items-center">
                @foreach ($rounds as $round)
                    @php
                        // Cari score yang sesuai dengan round dan user
                        $questionTaken = $round->questionTaken->where('user_id', auth()->id())->first();
                        $status = $questionTaken ? $questionTaken->status : 'locked';
                
                        // Ambil score untuk round yang sesuai
                        $userScore = $score->where('round_id', $round->id)->first();
                        $scoreValue = $userScore ? $userScore->score : '0'; // Atau nilai default jika tidak ada score
                    @endphp
                
                    @if ($status === 'unlocked')
                        {{-- Ronde yang terbuka --}}
                        <a href="{{ route('user.popup', ['roundId' => $round->id, 'questionIndex' => 0]) }}"
                            class="btn btn-start2 mb-4 rounded-custom w-100 text-start shadow-lg d-flex justify-content-between align-items-center">
                            {{ $round->name }} <span class="float-end number-anim" style="margin-right: 1rem;" data-target="{{ $scoreValue }}">0</span>
                        </a>
                    @elseif ($status === 'completed')
                        {{-- Ronde yang sudah selesai --}}
                        <button class="btn btn-start2 mb-4 rounded-custom w-100 text-start shadow-lg d-flex justify-content-between align-items-center" disabled>
                            {{ $round->name }} 
                            <div class="score">
                                <span class="number-anim" style="margin-right: 1rem;" data-target="{{ $scoreValue }}">0</span>
                                <img class="float-end" src="{{ asset('assets/img/Group.png') }}" alt="Completed" />
                            </div>
                        </button>
                    @else
                        {{-- Ronde yang terkunci --}}
                        <button class="btn btn-start2 mb-4 rounded-custom w-100 text-start shadow-lg d-flex justify-content-between align-items-center" disabled>
                            {{ $round->name }} 
                            <div class="score">
                                <span class="number-anim" style="margin-right: 1rem;" data-target="{{ $scoreValue }}">0</span>
                                <img class="float-end" src="{{ asset('assets/img/Group.png') }}" alt="Completed" />
                            </div>
                        </button>
                    @endif
                @endforeach
            </div>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const animatedNumbers = document.querySelectorAll('.number-anim');

            animatedNumbers.forEach(function(element) {
                const targetNumber = parseInt(element.getAttribute('data-target'), 10);
                let currentNumber = 0;

                // Animate the number counting from 0 to the target number
                function countUp() {
                    if (currentNumber < targetNumber) {
                        currentNumber++;
                        element.textContent = currentNumber;
                        setTimeout(countUp, 10); // Adjust speed here (higher value for slower count)
                    }
                }
                countUp();
            });
        });

    </script>
@endsection
@section('footer')
<style>
    .floating-logout {
        position: fixed;
        bottom: 20px;
        right: 20px;
    }

    .floating-menu {
        position: fixed;
        bottom: 2rem;
        right: 20px;
    }

    .menu-content {
        display: none;
        position: absolute;
        bottom: 50px;
        right: 0;
        background-color: white;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        border-radius: 5px;
        overflow: hidden;
    }

    .menu-item {
        display: block;
        padding: 10px 20px;
        text-decoration: none;
        color: black;
    }

    .menu-item:hover {
        background-color: #f1f1f1;
    }
    .btn4{
        width: 10rem !important;
        height: 3rem;
        background-color: white !important;
        font-family: "Poppins", sans-serif;
        font-weight: 500;
        font-style: normal;
    }
</style>
    <div class="floating-menu">
        <button class="btn2 btn-primary rounded-circle shadow-lg" id="menuButton">
            <i class="fas fa-bars"></i>
        </button>
        <div class="menu-content" id="menuContent">            
            <form action="{{ route('logout') }}" method="POST" class="menu-item">
                @csrf
                <button type="submit" class="btn btn4 menu-item">
                    Logout
                </button>
            </form>
        </div>
    </div>
    <script>
        document.getElementById('menuButton').addEventListener('click', function() {
            var menuContent = document.getElementById('menuContent');
            if (menuContent.style.display === 'block') {
                menuContent.style.display = 'none';
            } else {
                menuContent.style.display = 'block';
            }
        });
    </script>
@endsection