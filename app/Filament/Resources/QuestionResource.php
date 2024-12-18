<?php

namespace App\Filament\Resources;

use App\Filament\Resources\QuestionResource\Pages;
use App\Filament\Resources\QuestionResource\RelationManagers;
use App\Models\Question;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Filament\Forms\Components\Json;
use Filament\Forms\Components\TextInput;  
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\DateTimePicker; 
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\FileUpload;
use Filament\Tables\Columns\ImageColumn;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\RichEditor;

class QuestionResource extends Resource
{
    protected static ?string $model = Question::class;

    protected static ?string $navigationIcon = 'heroicon-o-question-mark-circle';

    public static function form(Form $form): Form
    {
        return $form->schema([
            // Input soal dalam bentuk teks
            RichEditor::make('content')
                ->label('Question Content')
                ->required()
                ->maxLength(255)
                ->columnSpan(2) // Membuat lebar input lebih lebar
                ->helperText('Enter the content of the question.'),
        
            // Input untuk gambar soal
            FileUpload::make('image')
                ->label('Question Image')
                ->image() // Menandakan bahwa hanya gambar yang dapat diunggah
                ->disk('public') // Tentukan disk untuk menyimpan gambar
                ->directory('questions') // Direktori untuk gambar soal
                ->required(false)
                ->columnSpan(2), // Membuat lebar file upload sedikit lebih kecil
                
        
            // Input JSON untuk opsi jawaban
            Textarea::make('options')
                ->label('Options')
                ->required()
                ->helperText('Input options as JSON (e.g., {"a": "Option A", "b": "Option B", "c": "Option C", "d": "Option D"})')
                ->default(
                    '{"a": "", "b": "", "c": "", "d": ""}'
                    )
                ->columnSpan(2), // Lebar lebih besar untuk input opsi
        
            // Pilihan jawaban yang benar
            Select::make('correct_option')
                ->label('Correct Answer')
                ->options([
                    'A' => 'A',
                    'B' => 'B',
                    'C' => 'C',
                    'D' => 'D',
                ])
                ->required()
                ->columnSpan(1), // Lebar input lebih kecil
        
            // Pilih ID babak
            Select::make('round_id')
                ->label('Round ID')
                ->options(
                    \App\Models\Round::all()->pluck('name', 'id')
                )
                ->required()
                ->columnSpan(1), // Lebar input lebih kecil
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
            
                Tables\Columns\TextColumn::make('content')
                    ->label('Content')
                    ->limit(20) 
                    ->searchable(),
                
                // ImageColumn::make('image')
                //     ->label('Image')
                //     ->disk('public') // Disk tempat penyimpanan gambar
                //     ->url(function ($record) {
                //         return $record->image ? asset('storage/' . $record->image) : null; // URL penuh gambar
                //     })
                //     ->circular(), // Opsional: Membuat gambar berbentuk lingkaran
                
                
                Tables\Columns\TextColumn::make('correct_option')
                    ->label('Correct Option'),
                
                Tables\Columns\TextColumn::make('round.name') // Menggunakan relasi
                    ->label('Round')
                    ->sortable()
                    ->formatStateUsing(function ($state, $record) {
                        return $record->round->name ?? 'No Round';
                    }),
                    
                
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
            'index' => Pages\ListQuestions::route('/'),
            'create' => Pages\CreateQuestion::route('/create'),
            'edit' => Pages\EditQuestion::route('/{record}/edit'),
        ];
    }    
}