@extends('user/layout')

@section('content')
    <style>
        body {
            margin: 0;
            display: flex;
            background-color: #00c2e7;
            justify-content: center; 
            align-items: center; 
        }

        .fade-in {
            opacity: 0;
            animation: fadeIn 2s forwards;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
            }
            to {
                opacity: 1;
            }
        }

        .fade-out {
            opacity: 1;
            animation: fadeOut 1s forwards;
        }

        @keyframes fadeOut {
            from {
                opacity: 1;
            }
            to {
                opacity: 0;
            }
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

    <main class="container-leaderboard fade-in">
        <div class="img d-flex justify-content-center">
            <img src="{{ asset('assets/img/logofikfair5.png') }}" alt="" width="400">
        </div>
        <section class="winner-section">
            <div class="winner-board">
                <div class="title-section">
                    <div class="icon-wrapper">
                        <i class="fas fa-award"></i>
                    </div>
                    <h1>Leaderboard</h1>
                </div>

                <div id="winner-list">
                    @foreach ($leaders as $index => $leader)
                        <div class="winner">
                            <div class="ordinal">
                                {{ $index + 1 }}
                            </div>
                            <div class="icon" style="background-color: #fff;">
                                <i class="fa fa-user" style="font-size: 1.2rem; color: #333;"></i>
                            </div>
                            <div class="winner-name">
                                <h4>{{ $leader->user->name }}</h4>
                                <span>{{ floor($leader->responses_time / 60) }} menit {{ $leader->responses_time % 60 }} detik</span>
                            </div>
                            <div class="winner-info">
                                <span class="winner-info number-anim" style="margin-right: 1rem;" data-target="{{ $leader->score }}">0</span>
                            </div>
                        </div>
                    @endforeach

                    @if (!$isInQualification)
                        <div class="winner">
                            <div class="ordinal">
                                Anda peringkat ke - {{ $loggedInUserRank }}
                            </div>
                            <div class="icon" style="background-color: #ffcc00;">
                                <i class="fa fa-user" style="font-size: 1.2rem; color: #333;"></i>
                            </div>
                            <div class="winner-name">
                                <h4>{{ auth()->user()->name }}</h4>
                                <span>(Di luar kualifikasi {{ $qualification }})</span>
                            </div>
                            <div class="winner-info">
                                <span>
                                    {{ auth()->user()->score }}
                                </span>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </section>
    </main>
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
                        setTimeout(countUp, 0.1); // Adjust speed here (higher value for slower count)
                    }
                }
                countUp();
            });
        });
    </script>
    <script>
        setTimeout(function() {
            document.querySelector('.fade-in').classList.add('fade-out');
            setTimeout(function() {
                window.location.href = "{{ route('user.level') }}";
            }, 1000); 
        }, 60000); 
    </script>
    <!-- Include confetti library -->
    <script src="https://cdn.jsdelivr.net/npm/canvas-confetti@1.6.0/dist/confetti.browser.min.js"></script>
    <script>
        // Run confetti when the page loads
        document.addEventListener('DOMContentLoaded', function() {
            // Generate confetti
            const confettiSettings = {
                particleCount: 15,
                startVelocity: 30,
                spread: 50,
                origin: { x: 0.5, y: -0.1 }
            };

            // Fire confetti multiple times for a celebratory effect
            const duration = 2000; // Total duration in ms
            const end = Date.now() + duration;

            const frame = () => {
                confetti({
                    ...confettiSettings,
                    angle: Math.random() * 90 + 45, // Randomize angle
                    ticks: 300 // Lifetime of particles
                });
                if (Date.now() < end) {
                    requestAnimationFrame(frame);
                }
            };

            frame();
        });
    </script>
@endsection