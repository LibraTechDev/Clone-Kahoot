<?php

namespace App\Filament\Resources\QuestionTakenResource\Pages;

use App\Filament\Resources\QuestionTakenResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditQuestionTaken extends EditRecord
{
    protected static string $resource = QuestionTakenResource::class;

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
