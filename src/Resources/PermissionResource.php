<?php

namespace Webrek\MongoPermissionFilament\Resources;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Webrek\MongoPermission\Models\Permission;
use Webrek\MongoPermissionFilament\Resources\PermissionResource\Pages;

class PermissionResource extends Resource
{
    protected static ?string $model = Permission::class;

    protected static ?string $navigationIcon = 'heroicon-o-key';

    protected static ?string $navigationGroup = 'Access control';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\TextInput::make('name')
                ->required()
                ->maxLength(120)
                ->helperText('A name containing "*" is treated as a wildcard.'),
            Forms\Components\Select::make('guard_name')
                ->options(fn () => collect(config('permission.guard_names', ['web']))->mapWithKeys(fn ($g) => [$g => $g]))
                ->default(config('permission.default_guard', 'web'))
                ->required(),
            Forms\Components\TextInput::make('team_id')
                ->label('Team ID')
                ->helperText('Leave blank for a global permission.')
                ->nullable(),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable()
                    ->sortable()
                    ->badge()
                    ->color(fn ($state) => str_contains((string) $state, '*') ? 'warning' : 'gray'),
                Tables\Columns\TextColumn::make('guard_name')->label('Guard')->sortable(),
                Tables\Columns\TextColumn::make('team_id')->label('Team')->default('global'),
                Tables\Columns\TextColumn::make('created_at')->dateTime()->sortable()->toggleable(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('guard_name')
                    ->label('Guard')
                    ->options(fn () => collect(config('permission.guard_names', ['web']))->mapWithKeys(fn ($g) => [$g => $g])),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPermissions::route('/'),
            'create' => Pages\CreatePermission::route('/create'),
            'edit' => Pages\EditPermission::route('/{record}/edit'),
        ];
    }
}
