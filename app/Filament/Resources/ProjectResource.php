<?php

namespace App\Filament\Resources;

use App\Filament\Resources\Concerns\BaseResource;
use App\Filament\Resources\ProjectResource\Pages;
use App\Models\Project;
use Filament\Actions;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\TagsInput;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables;
use Filament\Tables\Table;

class ProjectResource extends Resource
{
    use BaseResource;

    protected static ?string $model = Project::class;

    protected static \BackedEnum|string|null $navigationIcon = 'heroicon-o-rocket-launch';

    protected static \UnitEnum|string|null $navigationGroup = 'Portofolio';

    public static function form(Schema $form): Schema
    {
        return $form
            ->schema([
                TextInput::make('title')
                    ->label('Nama Proyek')
                    ->required()
                    ->maxLength(255),
                RichEditor::make('description')
                    ->label('Deskripsi')
                    ->required()
                    ->columnSpanFull(),
                TextInput::make('url')
                    ->label('Tautan Proyek')
                    ->url()
                    ->maxLength(255),
                FileUpload::make('image')
                    ->label('Gambar')
                    ->image()
                    ->imageEditor()
                    ->directory('projects'),
                TagsInput::make('tags')
                    ->label('Teknologi'),
                Toggle::make('featured')
                    ->label('Proyek Unggulan'),
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
                    ->label('Nama Proyek')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('url')
                    ->label('URL')
                    ->toggleable()
                    ->copyable(),
                Tables\Columns\TagsColumn::make('tags')
                    ->label('Teknologi')
                    ->toggleable(),
                Tables\Columns\IconColumn::make('featured')
                    ->label('Unggulan')
                    ->boolean()
                    ->toggleable(),
                Tables\Columns\TextColumn::make('sort_order')
                    ->label('Urutan')
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->label('Diperbarui')
                    ->dateTime()
                    ->sortable()
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
            'index' => Pages\ListProjects::route('/'),
            'create' => Pages\CreateProject::route('/create'),
            'edit' => Pages\EditProject::route('/{record}/edit'),
        ];
    }
}
