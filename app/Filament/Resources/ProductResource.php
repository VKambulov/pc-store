<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProductResource\Pages;
use App\Models\Product;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class ProductResource extends Resource
{
    protected static ?string $model = Product::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function getModelLabel(): string
    {
        return __('products.product');
    }

    public static function getPluralModelLabel(): string
    {
        return __('products.products');
    }

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Section::make()
                ->schema([
                    Forms\Components\TextInput::make('name')
                        ->label(__('products.name'))
                        ->required()
                        ->maxLength(255),
                    Forms\Components\TextInput::make('price')
                        ->label(__('products.price'))
                        ->required()
                        ->numeric()
                        ->postfix('₽'),
                    Forms\Components\RichEditor::make('description')
                        ->label(__('products.description'))
                        ->maxLength(65535)
                        ->columnSpanFull(),
                ])
                ->columns(),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label(__('products.name'))
                    ->searchable(),
                Tables\Columns\TextColumn::make('price')
                    ->label(__('products.price'))
                    ->money('rub')
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
            'index' => Pages\ListProducts::route('/'),
            'create' => Pages\CreateProduct::route('/create'),
            'edit' => Pages\EditProduct::route('/{record}/edit'),
        ];
    }
}
