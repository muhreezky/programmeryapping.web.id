<?php

namespace App\Filament\Resources;

use App\Filament\Resources\Concerns\BaseResource;
use App\Filament\Resources\PostResource\Pages;
use App\Models\Post;
use Filament\Actions;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class PostResource extends Resource
{
    use BaseResource;

    protected static ?string $model = Post::class;

    protected static \BackedEnum|string|null $navigationIcon = 'heroicon-o-newspaper';

    protected static \UnitEnum|string|null $navigationGroup = 'Konten';

    public static function form(Schema $form): Schema
    {
        return $form
            ->schema([
                TextInput::make('title')
                    ->label('Judul')
                    ->required()
                    ->maxLength(255),
                FileUpload::make('headline_image')
                    ->label('Gambar Headline')
                    ->image()
                    ->imageEditor()
                    ->directory('posts')
                    ->required(),
                RichEditor::make('content')
                    ->label('Konten')
                    ->required()
                    ->columnSpanFull(),
            ])
            ->columns(1);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->modifyQueryUsing(fn (Builder $query) => $query->where('author_id', auth()->id()))
            ->columns([
                Tables\Columns\TextColumn::make('title')
                    ->label('Judul')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('author.name')
                    ->label('Penulis')
                    ->sortable(),
                Tables\Columns\ImageColumn::make('headline_image')
                    ->label('Gambar Headline'),
                Tables\Columns\TextColumn::make('slug')
                    ->label('Slug')
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Dibuat')
                    ->dateTime()
                    ->sortable()
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
            ->actions([
                Actions\EditAction::make(),
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
            'index' => Pages\ListPosts::route('/'),
            'create' => Pages\CreatePost::route('/create'),
            'edit' => Pages\EditPost::route('/{record}/edit'),
        ];
    }
}
