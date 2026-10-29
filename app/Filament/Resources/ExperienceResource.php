<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ExperienceResource\Pages;
use App\Models\Experience;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ExperienceResource extends Resource
{
    protected static ?string $model = Experience::class;

    protected static ?string $navigationIcon = 'heroicon-o-briefcase';

    protected static ?string $navigationGroup = 'Portofolio';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('title')
                    ->label('Jabatan')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('company')
                    ->label('Perusahaan')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('employment_type')
                    ->label('Tipe Pekerjaan')
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
                    ->label('Masih Bekerja di Sini')
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
                Tables\Columns\TextColumn::make('title')
                    ->label('Jabatan')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('company')
                    ->searchable(),
                Tables\Columns\TextColumn::make('employment_type')
                    ->badge()
                    ->toggleable(),
                Tables\Columns\TextColumn::make('started_at')
                    ->date('M Y')
                    ->sortable()
                    ->toggleable(),
                Tables\Columns\TextColumn::make('ended_at')
                    ->date('M Y')
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
            'index' => Pages\ListExperiences::route('/'),
            'create' => Pages\CreateExperience::route('/create'),
            'edit' => Pages\EditExperience::route('/{record}/edit'),
        ];
    }
}
