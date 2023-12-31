<?php

namespace App\Filament\Resources;

use App\Enums\OrderStatus;
use App\Enums\OrderType;
use App\Filament\Resources\OrderResource\Pages;
use App\Filament\Resources\OrderResource\RelationManagers\ProductsRelationManager;
use App\Models\Order;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class OrderResource extends Resource
{
    protected static ?string $model = Order::class;

    protected static ?string $navigationIcon = 'heroicon-o-truck';

    public static function getModelLabel(): string
    {
        return __('orders.order');
    }

    public static function getPluralModelLabel(): string
    {
        return __('orders.orders');
    }

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Section::make()
                ->schema([
                    Forms\Components\TextInput::make('order_num')
                        ->label(__('orders.order_num'))
                        ->maxLength(20),
                    Forms\Components\Select::make('user_id')
                        ->label(__('users.user'))
                        ->required()
                        ->options(User::all()->pluck('name', 'id'))
                        ->searchable(),
                    Forms\Components\Select::make('type')
                        ->label(__('orders.type'))
                        ->required()
                        ->options(OrderType::class),
                    Forms\Components\Select::make('status')
                        ->label(__('orders.status'))
                        ->required()
                        ->options(OrderStatus::class),
                ])
                ->columns(),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('order_num')
                    ->label(__('orders.order_num'))
                    ->searchable(),
                Tables\Columns\TextColumn::make('type')
                    ->label(__('orders.type'))
                    ->badge()
                    ->alignCenter()
                    ->searchable(),
                Tables\Columns\TextColumn::make('status')
                    ->label(__('orders.status'))
                    ->badge()
                    ->alignCenter()
                    ->searchable(),
                Tables\Columns\TextColumn::make('user.name')
                    ->label(__('users.user'))
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
        return [ProductsRelationManager::class];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListOrders::route('/'),
            'create' => Pages\CreateOrder::route('/create'),
            'edit' => Pages\EditOrder::route('/{record}/edit'),
        ];
    }
}
