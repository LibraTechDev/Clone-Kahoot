<?php

namespace App\Filament\Resources\QuestionTakenResource\Pages;

use App\Filament\Resources\QuestionTakenResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListQuestionTakens extends ListRecords
{
    protected static string $resource = QuestionTakenResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
