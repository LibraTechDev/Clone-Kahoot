<?php

namespace App\Filament\Resources;

use App\Filament\Resources\QuestionTakenResource\Pages;
use App\Filament\Resources\QuestionTakenResource\RelationManagers;
use App\Models\QuestionTaken;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class QuestionTakenResource extends Resource
{
    protected static ?string $model = QuestionTaken::class;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('user.id')
                    ->required()
                    ->maxLength(50)
                    ->formatStateUsing(function ($state, $record) {
                        return $record->user->name ?? 'No Name';
                    })
                    ->disabled(),

                TextInput::make('round.id')
                    ->required()
                    ->formatStateUsing(function ($state, $record) {
                        return $record->round->name ?? 'No Round';
                    })
                    ->disabled()
                    ->maxLength(50),

                Select::make('status')
                    ->label('Status')
                    ->options([
                        'Locked' => 'Locked',
                        'Unlocked' => 'Unlocked',
                        'Completed' => 'Completed',
                    ])
                    ->required()
                    ->columnSpan(1),

                TextInput::make('score')
                    ->required()
                    ->maxLength(50),
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

                Tables\Columns\TextColumn::make('user.id') // Menggunakan relasi
                    ->label('Nama User')
                    ->sortable()
                    ->searchable()
                    ->formatStateUsing(function ($state, $record) {
                        return $record->user->name ?? 'No Name';
                    }),

                Tables\Columns\TextColumn::make('round.id') // Menggunakan relasi
                    ->label('Round')
                    ->sortable()
                    ->formatStateUsing(function ($state, $record) {
                        return $record->round->name ?? 'No Round';
                    }),

                Tables\Columns\TextColumn::make('status')
                    ->label('Status')
                    ->searchable(),

                Tables\Columns\TextColumn::make('score')
                    ->label('Score'),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Created At')
                    ->dateTime('d-m-Y H:i'),

                Tables\Columns\TextColumn::make('updated_at')
                    ->label('Updated At')
                    ->dateTime('d-m-Y H:i'),

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
            'index' => Pages\ListQuestionTakens::route('/'),
            'edit' => Pages\EditQuestionTaken::route('/{record}/edit'),
        ];
    }
}