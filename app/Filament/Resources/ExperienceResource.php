<?php

namespace App\Filament\Resources;

use App\Filament\Resources\Concerns\BaseResource;
use App\Filament\Resources\ExperienceResource\Pages;
use App\Models\Experience;
use Filament\Actions;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Resources\Resource;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Schemas\Schema;
use Filament\Tables;
use Filament\Tables\Table;

class ExperienceResource extends Resource
{
    use BaseResource;

    protected static ?string $model = Experience::class;

    protected static \BackedEnum|string|null $navigationIcon = 'heroicon-o-briefcase';

    protected static \UnitEnum|string|null $navigationGroup = 'Portofolio';

    public static function form(Schema $form): Schema
    {
        return $form
            ->schema([
                TextInput::make('title')
                    ->label('Jabatan')
                    ->required()
                    ->maxLength(255),
                TextInput::make('company')
                    ->label('Perusahaan')
                    ->required()
                    ->maxLength(255),
                TextInput::make('employment_type')
                    ->label('Tipe Pekerjaan')
                    ->maxLength(255),
                RichEditor::make('description')
                    ->label('Deskripsi')
                    ->columnSpanFull(),
                DatePicker::make('started_at')
                    ->label('Mulai')
                    ->required(),
                DatePicker::make('ended_at')
                    ->label('Selesai')
                    ->hidden(fn (Get $get) => (bool) $get('is_current')),
                Toggle::make('is_current')
                    ->label('Masih Bekerja di Sini')
                    ->live()
                    ->afterStateUpdated(function (Set $set, $state) {
                        if ($state) {
                            $set('ended_at', null);
                        }
                    }),
                TextInput::make('sort_order')
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
                    ->label('Perusahaan')
                    ->searchable(),
                Tables\Columns\TextColumn::make('employment_type')
                    ->label('Tipe')
                    ->badge()
                    ->toggleable(),
                Tables\Columns\TextColumn::make('started_at')
                    ->label('Mulai')
                    ->date('M Y')
                    ->sortable()
                    ->toggleable(),
                Tables\Columns\TextColumn::make('ended_at')
                    ->label('Selesai')
                    ->date('M Y')
                    ->placeholder('Sekarang')
                    ->toggleable(),
                Tables\Columns\IconColumn::make('is_current')
                    ->label('Saat Ini')
                    ->boolean()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('sort_order')
                    ->label('Urutan')
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->defaultSort('sort_order')
            ->actions([
                Actions\EditAction::make(),
                Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Actions\BulkActionGroup::make([
                    Actions\DeleteBulkAction::make(),
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
