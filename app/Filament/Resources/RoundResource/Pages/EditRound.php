<?php

namespace App\Filament\Resources\RoundResource\Pages;

use App\Filament\Resources\RoundResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditRound extends EditRecord
{
    protected static string $resource = RoundResource::class;

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
