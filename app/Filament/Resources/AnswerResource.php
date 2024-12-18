<?php

namespace App\Filament\Resources;

use App\Models\Question;
use App\Filament\Resources\AnswerResource\Pages;
use App\Filament\Resources\AnswerResource\RelationManagers;
use App\Models\Answer;
use Filament\Forms;
use Carbon\Carbon;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Forms\Components\Toggle;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\BooleanColumn;
use Filament\Tables\Columns\NumberColumn;
use Filament\Forms\Components\TextInput; 
use Filament\Forms\Components\DateTimePicker; 
use Filament\Forms\Components\Select;   
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class AnswerResource extends Resource
{
    protected static ?string $model = Answer::class;

    protected static ?string $navigationIcon = 'heroicon-o-check-circle';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('user_id')
                    ->label('User')
                    ->options(\App\Models\User::pluck('name', 'id')) // Mengambil data user dengan name sebagai label dan id sebagai value
                    ->searchable() // Menambahkan fitur pencarian
                    ->required(),

                Select::make('question_id')
                    ->label('Question')
                    ->options(\App\Models\Question::pluck('content', 'id')) // Mengambil data question dengan content sebagai label dan id sebagai value
                    ->searchable() // Menambahkan fitur pencarian
                    ->required(),
                Select::make('selected_option')
                    ->label('Selected Option')
                    ->options([
                        'A' => 'A',
                        'B' => 'B',
                        'C' => 'C',
                        'D' => 'D',
                    ])
                    ->required()
                    ->reactive() // Aktifkan reaktivitas
                    ->afterStateUpdated(function ($state, callable $set, $get) {
                        // Ambil correct_option dari pertanyaan terkait
                        $question = Question::find($get('question_id'));
                
                        // Periksa apakah jawaban sesuai dengan correct_option
                        if ($question && $state === $question->correct_option) {
                            $set('is_correct', true); // Jika benar, set is_correct ke true
                        } else {
                            $set('is_correct', false); // Jika salah, set is_correct ke false
                        }
                    }),                
                TextInput::make('responses_time')
                    ->label('Responses Time')
                    ->required()
                    ->dehydrateStateUsing(function ($state) {
                        // Konversi ke format datetime
                        return Carbon::now()->addSeconds($state)->toDateTimeString();
                    })
                    ->placeholder('Enter time in seconds'),
                Toggle::make('is_correct')
                    ->label('Is Correct')
                    ->required()
                    ->disabled(), // Nonaktifkan input manual
                TextInput::make('points')
                    ->label('Points')
                    ->numeric()
                    ->required(),
                
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('user.name') // Menggunakan relasi 'user' untuk mengambil field 'name'
                    ->label('UserName')
                    ->sortable()
                    ->searchable(),

                TextColumn::make('question.content') // Menggunakan relasi 'question' untuk mengambil field 'content'
                    ->label('Question Content')
                    ->sortable()
                    ->searchable()
                    ->limit(20), // Batasi teks hingga 50 karakter
                TextColumn::make('selected_option')
                    ->label('Selected Option')
                    ->sortable(),
                TextColumn::make('responses_time')
                    ->label('Responses Time')
                    ->sortable(),
                BooleanColumn::make('is_correct')
                    ->label('Is Correct')
                    ->sortable(),
                TextColumn::make('points')
                    ->label('Points')
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
            'index' => Pages\ListAnswers::route('/'),
            'create' => Pages\CreateAnswer::route('/create'),
            'edit' => Pages\EditAnswer::route('/{record}/edit'),
        ];
    }    
}