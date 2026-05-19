<?php

namespace Webrek\MongoPermissionFilament\Resources;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Webrek\MongoPermission\Models\Role;
use Webrek\MongoPermissionFilament\Resources\RoleResource\Pages;

class RoleResource extends Resource
{
    protected static ?string $model = Role::class;

    protected static ?string $navigationIcon = 'heroicon-o-user-group';

    protected static ?string $navigationGroup = 'Access control';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\TextInput::make('name')
                ->required()
                ->maxLength(120),
            Forms\Components\Select::make('guard_name')
                ->options(fn () => collect(config('permission.guard_names', ['web']))->mapWithKeys(fn ($g) => [$g => $g]))
                ->default(config('permission.default_guard', 'web'))
                ->required(),
            Forms\Components\TextInput::make('team_id')
                ->label('Team ID')
                ->helperText('Leave blank for a global role.')
                ->nullable(),
            Forms\Components\Select::make('permission_ids')
                ->label('Permissions')
                ->multiple()
                ->options(fn () => \Webrek\MongoPermission\Models\Permission::query()
                    ->orderBy('name')
                    ->get()
                    ->mapWithKeys(fn ($p) => [(string) $p->getKey() => $p->name])
                    ->all())
                ->searchable(),
            Forms\Components\Select::make('parent_role_ids')
                ->label('Inherits from')
                ->multiple()
                ->options(fn ($record) => Role::query()
                    ->when($record, fn ($q) => $q->where('_id', '!=', $record->getKey()))
                    ->orderBy('name')
                    ->get()
                    ->mapWithKeys(fn ($r) => [(string) $r->getKey() => $r->name])
                    ->all())
                ->helperText('Roles whose permissions this role transitively grants.')
                ->searchable(),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('guard_name')->label('Guard')->sortable(),
                Tables\Columns\TextColumn::make('team_id')->label('Team')->default('global'),
                Tables\Columns\TextColumn::make('permission_ids')
                    ->label('Permissions')
                    ->formatStateUsing(fn ($state) => is_array($state) ? count($state) . ' perms' : '0'),
                Tables\Columns\TextColumn::make('parent_role_ids')
                    ->label('Parents')
                    ->formatStateUsing(fn ($state) => is_array($state) ? count($state) : 0),
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
            'index' => Pages\ListRoles::route('/'),
            'create' => Pages\CreateRole::route('/create'),
            'edit' => Pages\EditRole::route('/{record}/edit'),
        ];
    }
}
