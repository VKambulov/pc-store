<?php

namespace App\Filament\Resources\OrderResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;

class ProductsRelationManager extends RelationManager
{
    protected static string $relationship = 'products';

    public function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\TextInput::make('name')
                ->label(__('products.name'))
                ->required()
                ->maxLength(255)
                ->columnSpan(2),
            Forms\Components\TextInput::make('price')
                ->label(__('products.price'))
                ->required()
                ->numeric()
                ->postfix('₽'),
            Forms\Components\TextInput::make('quantity')
                ->label(__('orders.quantity'))
                ->numeric()
                ->required()
                ->default(1)
                ->minValue(1)
                ->postfix('шт'),
        ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('name')
            ->heading(__('products.products'))
            ->columns([
                Tables\Columns\TextColumn::make('name')->label(
                    __('products.name'),
                ),
                Tables\Columns\TextColumn::make('pivot.price')
                    ->label(__('products.price'))
                    ->money('rub')
                    ->alignEnd(),
                Tables\Columns\TextColumn::make('quantity')
                    ->label(__('orders.quantity'))
                    ->suffix(' шт')
                    ->alignEnd(),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make()->modalHeading(
                    'Создать товар',
                ),
                Tables\Actions\AttachAction::make()
                    ->modalHeading('Прикрепить товар')
                    ->form(
                        fn(Tables\Actions\AttachAction $action): array => [
                            $action->getRecordSelect(),
                            Forms\Components\TextInput::make('price')
                                ->label(__('products.price'))
                                ->required()
                                ->numeric()
                                ->postfix('₽'),
                            Forms\Components\TextInput::make('quantity')
                                ->label(__('orders.quantity'))
                                ->numeric()
                                ->required()
                                ->default(1)
                                ->minValue(1)
                                ->postfix('шт'),
                        ],
                    )
                    ->preloadRecordSelect(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DetachAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DetachBulkAction::make(),
                ]),
            ]);
    }
}
