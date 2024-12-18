<?php

namespace App\Filament\Resources\LeaderboardResource\Pages;

use App\Filament\Resources\LeaderboardResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditLeaderboard extends EditRecord
{
    protected static string $resource = LeaderboardResource::class;

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
