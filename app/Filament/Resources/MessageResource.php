<?php

namespace App\Filament\Resources;

use App\Filament\Resources\Concerns\BaseResource;
use App\Filament\Resources\MessageResource\Pages;
use App\Models\Message;
use Filament\Actions;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Model;

class MessageResource extends Resource
{
    use BaseResource;

    protected static ?string $model = Message::class;

    protected static ?string $modelLabel = 'Message';

    protected static ?string $pluralModelLabel = 'Messages';

    protected static \BackedEnum|string|null $navigationIcon = 'heroicon-o-envelope';

    protected static \UnitEnum|string|null $navigationGroup = 'Konten';

    public static function form(Schema $form): Schema
    {
        return $form
            ->schema([
                TextInput::make('sender_email')
                    ->label('Email')
                    ->email()
                    ->required()
                    ->maxLength(255),
                TextInput::make('sender_name')
                    ->label('Nama')
                    ->required()
                    ->maxLength(255),
                TextInput::make('subject')
                    ->label('Subjek')
                    ->required()
                    ->maxLength(255),
                Textarea::make('content')
                    ->label('Pesan')
                    ->required()
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('sender_email')
                    ->label('Email')
                    ->searchable(),
                Tables\Columns\TextColumn::make('sender_name')
                    ->label('Nama')
                    ->searchable(),
                Tables\Columns\TextColumn::make('subject')
                    ->label('Subjek')
                    ->searchable(),
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
                Actions\ViewAction::make(),
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

    public static function canEdit(Model $record): bool
    {
        return false;
    }

    public static function canCreate(): bool
    {
        return false;
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListMessages::route('/'),
            'create' => Pages\CreateMessage::route('/create'),
            'view' => Pages\ViewMessage::route('/{record}'),
            'edit' => Pages\EditMessage::route('/{record}/edit'),
        ];
    }
}
