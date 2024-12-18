<?php

namespace App\Filament\Resources;

use App\Filament\Resources\LeaderboardResource\Pages;
use App\Filament\Resources\LeaderboardResource\RelationManagers;
use App\Models\Leaderboard;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Toggle;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class LeaderboardResource extends Resource
{
    protected static ?string $model = Leaderboard::class;

    protected static ?string $navigationIcon = 'heroicon-o-star';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('user_id')
                    ->label('User Name')
                    ->options(\App\Models\User::pluck('name', 'id'))
                    ->required(),

                // Select untuk round_id, menampilkan nama round
                Select::make('round_id')
                    ->label('Round Name')
                    ->options(\App\Models\Round::pluck('name', 'id'))
                    ->required(),
                Forms\Components\TextInput::make('rank')
                    ->label('Rank')
                    ->required(),
                Forms\Components\TextInput::make('total_points')
                    ->label('Total Points')
                    ->required(),
                Toggle::make('is_correct')
                    ->label('Is Correct')
                    ->disabled(), 
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')
                ->label('ID')
                ->getStateUsing(function ($rowLoop) {
                    return $rowLoop->index + 1; // Nomor urut mulai dari 1
                }),

                Tables\Columns\TextColumn::make('round.name')
                    ->label('Round ID')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('user.name') // Menggunakan relasi 'user' untuk mengambil field 'name'
                    ->label('User Name')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('rank')
                    ->label('Rank')
                    ->sortable(),
                Tables\Columns\TextColumn::make('total_points')
                    ->label('Total Points')
                    ->sortable(),
                Tables\Columns\TextColumn::make('score')
                    ->label('Score')
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }
    
    public static function getRelations(): array
    {
        return [
            //
        ];
    }
    
    public static function getPages(): array
    {
        return [
            'index' => Pages\ListLeaderboards::route('/'),
            'create' => Pages\CreateLeaderboard::route('/create'),
            'edit' => Pages\EditLeaderboard::route('/{record}/edit'),
        ];
    }    
}