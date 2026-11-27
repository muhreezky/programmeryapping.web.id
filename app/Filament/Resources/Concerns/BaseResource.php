<?php

namespace App\Filament\Resources\Concerns;

use Filament\Forms\Components\Actions;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\FileUpload\File;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TagsInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Get;
use Filament\Schemas\Schema;
use Filament\Tables\Actions\BulkActionGroup;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\DeleteBulkAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TagsColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

trait BaseResource
{
    /**
     * Get the default form schema with common fields.
     */
    protected function getBaseFormSchema(): array
    {
        return [
            TextInput::make('title')
                ->label('Judul')
                ->required()
                ->maxLength(255),
            RichEditor::make('description')
                ->label('Deskripsi')
                ->required()
                ->columnSpanFull(),
        ];
    }

    /**
     * Get the default table columns with common fields.
     */
    protected function getBaseTableColumns(): array
    {
        return [
            TextColumn::make('title')
                ->label('Judul')
                ->searchable()
                ->sortable(),
            TextColumn::make('created_at')
                ->label('Dibuat')
                ->dateTime()
                ->sortable()
                ->toggleable(isToggledHiddenByDefault: true),
            TextColumn::make('updated_at')
                ->label('Diperbarui')
                ->dateTime()
                ->sortable()
                ->toggleable(isToggledHiddenByDefault: true),
        ];
    }

    /**
     * Get the default table filters.
     */
    protected function getBaseTableFilters(): array
    {
        return [
            //
        ];
    }

    /**
     * Get the default table actions.
     */
    protected function getBaseTableActions(): array
    {
        return [
            EditAction::make(),
            DeleteAction::make(),
        ];
    }

    /**
     * Get the default bulk actions.
     */
    protected function getBaseBulkActions(): array
    {
        return [
            BulkActionGroup::make([
                DeleteBulkAction::make(),
            ]),
        ];
    }

    /**
     * Get the default pages.
     */
    protected function getBasePages(): array
    {
        return [
            'index' => \App\Filament\Resources\Pages\ListRecords::route('/'),
            'create' => \App\Filament\Resources\Pages\CreateRecord::route('/create'),
            'edit' => \App\Filament\Resources\Pages\EditRecord::route('/{record}/edit'),
        ];
    }

    /**
     * Get a standard text input field.
     */
    protected function textInput(string $name, string $label, bool $required = true, int $maxLength = 255): TextInput
    {
        $input = TextInput::make($name)
            ->label($label)
            ->maxLength($maxLength);

        return $required ? $input->required() : $input;
    }

    /**
     * Get a standard rich editor field.
     */
    protected function richEditor(string $name, string $label, bool $required = true): RichEditor
    {
        $editor = RichEditor::make($name)
            ->label($label)
            ->columnSpanFull();

        return $required ? $editor->required() : $editor;
    }

    /**
     * Get a standard file upload field.
     */
    protected function fileUpload(string $name, string $label, string $directory = 'images', bool $required = false): FileUpload
    {
        $upload = FileUpload::make($name)
            ->label($label)
            ->image()
            ->imageEditor()
            ->directory($directory);

        return $required ? $upload->required() : $upload;
    }

    /**
     * Get a standard tags input field.
     */
    protected function tagsInput(string $name, string $label): TagsInput
    {
        return TagsInput::make($name)
            ->label($label);
    }

    /**
     * Get a standard toggle field.
     */
    protected function toggle(string $name, string $label): Toggle
    {
        return Toggle::make($name)
            ->label($label);
    }

    /**
     * Get a standard date picker field.
     */
    protected function datePicker(string $name, string $label, bool $required = true): DatePicker
    {
        $picker = DatePicker::make($name)
            ->label($label);

        return $required ? $picker->required() : $picker;
    }

    /**
     * Get a standard number input field.
     */
    protected function numberInput(string $name, string $label, int $default = 0, int $min = 0): TextInput
    {
        return TextInput::make($name)
            ->label($label)
            ->numeric()
            ->default($default)
            ->minValue($min);
    }

    /**
     * Get a standard select field.
     */
    protected function select(string $name, string $label, array $options, bool $required = true, bool $searchable = false): Select
    {
        $select = Select::make($name)
            ->label($label)
            ->options($options)
            ->searchable($searchable);

        return $required ? $select->required() : $select;
    }

    /**
     * Get a standard textarea field.
     */
    protected function textarea(string $name, string $label, bool $required = true, int $rows = 4): Textarea
    {
        $textarea = Textarea::make($name)
            ->label($label)
            ->rows($rows);

        return $required ? $textarea->required() : $textarea;
    }

    /**
     * Get a standard text column for tables.
     */
    protected function textColumn(string $name, string $label, bool $searchable = true, bool $sortable = true, bool $toggleable = false): TextColumn
    {
        $column = TextColumn::make($name)
            ->label($label);

        if ($searchable) {
            $column->searchable();
        }

        if ($sortable) {
            $column->sortable();
        }

        if ($toggleable) {
            $column->toggleable(isToggledHiddenByDefault: true);
        }

        return $column;
    }

    /**
     * Get a standard image column for tables.
     */
    protected function imageColumn(string $name, string $label, bool $toggleable = false): ImageColumn
    {
        $column = ImageColumn::make($name)
            ->label($label);

        if ($toggleable) {
            $column->toggleable();
        }

        return $column;
    }

    /**
     * Get a standard icon (boolean) column for tables.
     */
    protected function iconColumn(string $name, string $label, bool $toggleable = false): IconColumn
    {
        $column = IconColumn::make($name)
            ->label($label)
            ->boolean();

        if ($toggleable) {
            $column->toggleable(isToggledHiddenByDefault: true);
        }

        return $column;
    }

    /**
     * Get a standard tags column for tables.
     */
    protected function tagsColumn(string $name, string $label, bool $toggleable = false): TagsColumn
    {
        $column = TagsColumn::make($name)
            ->label($label);

        if ($toggleable) {
            $column->toggleable();
        }

        return $column;
    }

    /**
     * Get a standard badge column for tables.
     */
    protected function badgeColumn(string $name, string $label, array $colors = [], bool $toggleable = false): BadgeColumn
    {
        $column = BadgeColumn::make($name)
            ->label($label)
            ->colors($colors);

        if ($toggleable) {
            $column->toggleable();
        }

        return $column;
    }

    /**
     * Apply author scoping to query (for user-owned resources).
     */
    protected function applyAuthorScope(Builder $query): Builder
    {
        return $query->where('author_id', auth()->id());
    }

    /**
     * Apply default sorting.
     */
    protected function applyDefaultSort(Table $table, string $column = 'sort_order'): Table
    {
        return $table->defaultSort($column);
    }

    /**
     * Check if user can edit record (default: true).
     */
    public static function canEdit(Model $record): bool
    {
        return true;
    }

    /**
     * Check if user can create records (default: true).
     */
    public static function canCreate(): bool
    {
        return true;
    }

    /**
     * Check if user can delete record (default: true).
     */
    public static function canDelete(Model $record): bool
    {
        return true;
    }

    /**
     * Check if user can view record (default: true).
     */
    public static function canView(Model $record): bool
    {
        return true;
    }
}
