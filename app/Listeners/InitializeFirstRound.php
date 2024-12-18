<?php

namespace App\Listeners;

use App\Models\Round;
use App\Models\QuestionTaken;
use Illuminate\Auth\Events\Registered;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class InitializeFirstRound
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle(Registered $event)
    {
        $user = $event->user;

        // Cari ronde pertama
        $firstRound = Round::orderBy('id', 'asc')->first();

        if ($firstRound) {
            // Buat entri untuk ronde pertama di question_taken
            QuestionTaken::create([
                'user_id' => $user->id,
                'round_id' => $firstRound->id,
                'status' => 'unlocked',
            ]);
        }
    }
}
