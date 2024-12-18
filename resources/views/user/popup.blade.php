@extends('user/layout')

@section('content')
<style>
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
<div class="d-flex flex-column justify-content-center  fade-in">
  <img
    src="{{ asset('assets/img/Illustrationlvl.png') }}"
    alt=""
    srcset=""
    class="logopop img-fluid"
  />
  <span class="text2">{{ preg_replace('/[^0-9]/', '', $round->name) }}</span>
  <span class="text-center text">{{ $round->name }}</span>
</div>

<script>
  setTimeout(function() {
      document.querySelector('.fade-in').classList.add('fade-out');
      setTimeout(function() {
          window.location.href = "{{ route('user.question', ['roundId' => $round->id, 'questionIndex' => 0]) }}";
      }, 1000); 
  }, 5000); 
</script>
@endsection