<?php

namespace App\Filament\Resources;

use App\Filament\Resources\EducationResource\Pages;
use App\Models\Education;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class EducationResource extends Resource
{
    protected static ?string $model = Education::class;

    protected static ?string $navigationIcon = 'heroicon-o-academic-cap';

    protected static ?string $navigationGroup = 'Portofolio';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('institution')
                    ->label('Institusi')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('degree')
                    ->label('Gelar / Jurusan')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('field_of_study')
                    ->label('Bidang Studi')
                    ->maxLength(255),
                Forms\Components\RichEditor::make('description')
                    ->label('Deskripsi')
                    ->columnSpanFull(),
                Forms\Components\DatePicker::make('started_at')
                    ->label('Mulai')
                    ->required(),
                Forms\Components\DatePicker::make('ended_at')
                    ->label('Selesai')
                    ->hidden(fn (Forms\Get $get) => (bool) $get('is_current')),
                Forms\Components\Toggle::make('is_current')
                    ->label('Sedang Bersekolah di Sini')
                    ->live()
                    ->afterStateUpdated(function (Forms\Set $set, $state) {
                        if ($state) {
                            $set('ended_at', null);
                        }
                    }),
                Forms\Components\TextInput::make('sort_order')
                    ->label('Urutan')
                    ->numeric()
                    ->default(0),
            ])
            ->columns(2);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('institution')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('degree')
                    ->searchable(),
                Tables\Columns\TextColumn::make('field_of_study')
                    ->toggleable(),
                Tables\Columns\TextColumn::make('started_at')
                    ->date('Y')
                    ->sortable()
                    ->toggleable(),
                Tables\Columns\TextColumn::make('ended_at')
                    ->date('Y')
                    ->placeholder('Sekarang')
                    ->toggleable(),
                Tables\Columns\IconColumn::make('is_current')
                    ->boolean()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('sort_order')
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->defaultSort('sort_order')
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
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
            'index' => Pages\ListEducation::route('/'),
            'create' => Pages\CreateEducation::route('/create'),
            'edit' => Pages\EditEducation::route('/{record}/edit'),
        ];
    }
}
