@extends('user.layout')
@section('content')
<div id="loading" class="load">
    <div class="loader"></div>
</div>
    <div class="container-fluid4">
        <div class="header-option">
            <a class="back-btn" href="{{ route('user.level') }}">
                <img class="back-icon" src="{{ asset('assets/img/Left-Arrow.svg') }}" />
                <span class="text-white">{{ $round->name }}</span>
            </a>
        </div>
        <div class="container-fluid2 rounded-top-5 custom-shadow">
            <div class="time-progress">
                <span>Waktu tersisa: <span id="countdown"></span></span>
                <div class="progress rounded-3" style="height: 30px; background-color: #004aad">
                    <div id="progress-bar" class="progress-bar rounded-3" role="progressbar"
                        style="width: 100%; background-color: #a5c8e6" aria-valuenow="100" aria-valuemin="0"
                        aria-valuemax="100"></div>
                </div>
            </div>

            <form id="Formquiz" action="{{ route('user.submit', ['roundId' => $round->id]) }}" method="POST">
                @csrf
                <input type="hidden" name="round_id" value="{{ $round->id }}">
                <div class="question-text">
                    <p><strong>Pertanyaan {{ $currentIndex + 1 }}:</strong> {{ $question->content }}</p>
                    @if ($question->image)
                        <img src="{{ asset('storage/' . $question->image) }}" alt="Question Image" class="img-fluid" />
                    @endif
                </div>

                <div class="form-answer rounded-3">
                    <div class="option-answer">
                        @foreach (json_decode($question->options, true) as $optionKey => $option)
                            <label class="checkbox-answer" for="jawaban_{{ $question->id }}_{{ $optionKey }}">
                                <input type="radio" name="selected_option[{{ $question->id }}]"
                                    id="jawaban_{{ $question->id }}_{{ $optionKey }}" value="{{ $optionKey }}"
                                    {{ session("round_{$round->id}_answers.{$question->id}") == $optionKey ? 'checked' : '' }}
                                    data-question-id="{{ $question->id }}" required hidden />
                                <div class="answer rounded-2">{{ $option }}</div>
                            </label>
                        @endforeach
                    </div>
                </div>

                <div class="d-flex justify-content-between mt-4">
                    @if ($currentIndex > 0)
                        <a href="{{ route('user.question', ['roundId' => $round->id, 'questionIndex' => $currentIndex - 1]) }}"
                            class="btn btn-primary nav-btn d-flex justify-content-center align-items-center">Back</a>
                    @endif

                    @if ($currentIndex < $totalQuestions - 1)
                        <a href="{{ route('user.question', ['roundId' => $round->id, 'questionIndex' => $currentIndex + 1]) }}"
                            class="btn btn-primary nav-btn d-flex justify-content-center align-items-center">Next</a>
                    @else
                        <button type="submit" class="btn btn-success">Submit</button>
                    @endif
                </div>
            </form>

        </div>
    </div>
    
    <script>
        window.addEventListener('load', function() {
            document.getElementById('loading').style.display = 'none';
        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Existing countdown script...

            // Tambahkan event listener untuk menyimpan jawaban sementara
            const radioButtons = document.querySelectorAll('input[type="radio"]');
            const navButtons = document.querySelectorAll('.nav-btn');

            radioButtons.forEach(radio => {
                radio.addEventListener('change', function() {
                    const questionId = this.getAttribute('data-question-id');
                    const selectedOption = this.value;

                    // Kirim jawaban sementara via AJAX
                    fetch('{{ route('user.save.temporary.answer', ['roundId' => $round->id]) }}', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: JSON.stringify({
                            question_id: questionId,
                            selected_option: selectedOption
                        })
                    });
                });
            });
        });
    </script>


    <script>
        document.addEventListener('DOMContentLoaded', function() {
            let timeLeft = {{ $duration }}; // Waktu dari server
            const totalDuration = {{ $round->duration }};

            const countdownElement = document.getElementById('countdown');
            const progressBar = document.getElementById('progress-bar');

            function updateCountdown() {
                let hours = Math.floor(timeLeft / 3600);
                let minutes = Math.floor((timeLeft % 3600) / 60);
                let seconds = timeLeft % 60;

                hours = String(hours).padStart(2, '0');
                minutes = String(minutes).padStart(2, '0');
                seconds = String(seconds).padStart(2, '0');

                countdownElement.textContent = `${hours}:${minutes}:${seconds}`;

                if (timeLeft > 0) {
                    timeLeft--;
                } else {
                    clearInterval(interval);
                    alert('Waktu habis!');
                    document.getElementById('Formquiz').submit();
                }
            }

            const interval = setInterval(updateCountdown, 1000);

            // Kirim waktu tersisa sebelum pindah soal
            const nextButtons = document.querySelectorAll('.btn-next');
            nextButtons.forEach(button => {
                button.addEventListener('click', function(e) {
                    e.preventDefault();

                    const form = document.createElement('form');
                    form.method = 'POST';
                    form.action = this.href;

                    const csrfInput = document.createElement('input');
                    csrfInput.type = 'hidden';
                    csrfInput.name = '_token';
                    csrfInput.value = '{{ csrf_token() }}';

                    const timeInput = document.createElement('input');
                    timeInput.type = 'hidden';
                    timeInput.name = 'time_left';
                    timeInput.value = timeLeft;

                    form.appendChild(csrfInput);
                    form.appendChild(timeInput);

                    document.body.appendChild(form);
                    form.submit();
                });
            });
        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const totalQuestions = {{ $totalQuestions }};
            const currentIndex = {{ $currentIndex }};
            const progressBar = document.getElementById('progress-bar');

            // Hitung dan perbarui progress bar
            function updateProgressBar(index) {
                const percentage = ((index + 1) / totalQuestions) * 100;
                progressBar.style.width = `${percentage}%`;
            }

            // Inisialisasi progress bar saat halaman dimuat
            updateProgressBar(currentIndex);
        });
    </script>
@endsection
