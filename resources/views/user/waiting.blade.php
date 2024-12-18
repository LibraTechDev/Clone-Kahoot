@extends('user/layout')

@section('content')
<script src="https://unpkg.com/@dotlottie/player-component@2.7.12/dist/dotlottie-player.mjs" type="module"></script>
<style>
    .waiting-room {
        text-align: center; 
        background-color: #ffffff; 
        border-radius: 15px; 
        padding: 30px; 
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.3);
        max-width: 600px; 
        width: 90%; 
    }
    h3 {
        margin: 15px 0;
    }
    dotlottie-player {
        margin: 10px 0;
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
</style>
<div id="waitingRoom" class="waiting-room fade-in">
    <div class="row justify-content-center align-items-center">
        <div class="col-12">
            <h3>WAITING ROOM !</h3>
        </div>
        <div class="col-12 d-flex justify-content-center">
            <dotlottie-player 
                src="https://lottie.host/9831c413-b1f3-4fba-9898-d85309972ff2/eA3Xsgt17c.lottie" 
                background="transparent" 
                speed="1" 
                style="width: 200px; height: 200px;" 
                loop 
                autoplay>
            </dotlottie-player>
        </div>
        <div class="col-12">
            <h3>Waiting for the next round</h3>
        </div>
        <div class="col-12">
            <h3 id="countdown">Time Remaining: --:--</h3>
        </div>
    </div>
</div>

<script>
    // Mengambil waktu selesai dari session
    const storedEndTime = {{ session('round_'.$round->id.'_waitTime') }};

    // Hitung waktu tersisa
    function getTimeLeft() {
        const now = Math.floor(Date.now() / 1000);
        return Math.max(0, storedEndTime - now);
    }

    // Fungsi untuk memformat waktu dalam menit dan detik
    function formatTime(seconds) {
        const minutes = Math.floor(seconds / 60);
        const secs = seconds % 60;
        return `${String(minutes).padStart(2, '0')}:${String(secs).padStart(2, '0')}`;
    }

    // Update countdown setiap detik
    const countdownElement = document.getElementById('countdown');
    const interval = setInterval(() => {
        const timeLeft = getTimeLeft();
        if (timeLeft > 0) {
            countdownElement.textContent = `Time Remaining: ${formatTime(timeLeft)}`;
        } else {
            clearInterval(interval); // Hentikan countdown
            window.location.href = "{{ route('leaderboard', ['roundId' => $round->id]) }}"; // Redirect ke leaderboard
        }
    }, 1000);
</script>

@endsection
