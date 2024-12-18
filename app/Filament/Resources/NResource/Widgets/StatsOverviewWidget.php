<?php

namespace App\Filament\Resources\NResource\Widgets;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Card;
use App\Models\Round;
use App\Models\School;
use App\Models\Question;
use App\Models\User;

class StatsOverviewWidget extends BaseWidget
{
    protected function getCards(): array
    {
        return [
            Card::make('Jumlah Round', Round::count())->color('success'),
            Card::make('Jumlah School', School::count())->color('primary'),
            Card::make('Jumlah Question', Question::count())->color('warning'),
            Card::make('Jumlah User', User::count())->color('secondary'),
        ];
    }
}