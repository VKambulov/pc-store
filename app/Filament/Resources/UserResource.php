<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-user-group';

    public static function getModelLabel(): string
    {
        return __('users.user');
    }

    public static function getPluralModelLabel(): string
    {
        return __('users.users');
    }

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Section::make()
                ->schema([
                    Forms\Components\TextInput::make('name')
                        ->label(__('users.name'))
                        ->required()
                        ->maxLength(255),
                    Forms\Components\TextInput::make('surname')
                        ->label(__('users.surname'))
                        ->required()
                        ->maxLength(255),
                    Forms\Components\TextInput::make('patronymic')
                        ->label(__('users.patronymic'))
                        ->maxLength(255),
                    Forms\Components\TextInput::make('email')
                        ->email()
                        ->required()
                        ->maxLength(255)
                        ->columnSpan(2),
                    Forms\Components\DatePicker::make('date_of_birth')
                        ->label(__('users.date_of_birth'))
                        ->required(),
                    Forms\Components\Textarea::make('address')
                        ->label(__('users.address'))
                        ->maxLength(65535)
                        ->columnSpanFull(),
                ])
                ->columns(3),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label(__('users.name'))
                    ->searchable(),
                Tables\Columns\TextColumn::make('surname')
                    ->label(__('users.surname'))
                    ->searchable(),
                Tables\Columns\TextColumn::make('patronymic')
                    ->label(__('users.patronymic'))
                    ->searchable(),
                Tables\Columns\TextColumn::make('email')->searchable(),
                Tables\Columns\TextColumn::make('date_of_birth')
                    ->label(__('users.date_of_birth'))
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->label(__ucfirst('validation.attributes.created_at'))
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->label(__ucfirst('validation.attributes.updated_at'))
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([Tables\Actions\EditAction::make()])
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
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }
}
