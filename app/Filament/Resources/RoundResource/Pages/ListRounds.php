<?php

namespace App\Filament\Resources\RoundResource\Pages;

use App\Filament\Resources\RoundResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListRounds extends ListRecords
{
    protected static string $resource = RoundResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
