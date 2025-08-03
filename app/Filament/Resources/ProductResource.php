<?php

namespace App\Filament\Resources;

use App\Models\Product;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables\Table;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Textarea;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\BadgeColumn;

// GANTI INI!
use App\Filament\Resources\ProductResource\Pages;
use App\Filament\Resources\ProductResource\Pages\CreateProduct;
use App\Filament\Resources\ProductResource\Pages\EditProduct;
use App\Filament\Resources\ProductResource\Pages\ListProducts;

class ProductResource extends Resource
{
    protected static ?string $model = Product::class;

    protected static ?string $navigationIcon = 'heroicon-o-shopping-bag';
    protected static ?string $navigationLabel = 'Product';
    protected static ?string $pluralModelLabel = 'Produk';
    protected static ?string $modelLabel = 'Produk';

    public static function form(Form $form): Form
    {
        return $form->schema([
            TextInput::make('name')
                ->label('Nama Produk')
                ->required()
                ->maxLength(255),

            TextInput::make('slug')
                ->label('Slug')
                ->required()
                ->maxLength(255),

            TextInput::make('price')
                ->label('Harga')
                ->required()
                ->numeric()
                ->prefix('Rp'),

           FileUpload::make('image')
                ->label('Gambar Produk')
                ->image()
                ->directory('images/produk') // path dalam public/
                ->disk('public')             // ini sesuai yang di atas
                ->preserveFilenames()
                ->visibility('public')
                ->required(),

            Textarea::make('description')
                ->label('Deskripsi')
                ->rows(5)
                ->required(),

            TextInput::make('stock')
            ->label('Stok')
            ->required()
            ->numeric()
            ->minValue(0),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table->columns([
           ImageColumn::make('image')
                ->label('Foto')
                ->circular()
                ->getStateUsing(fn ($record) => asset($record->image)),

            TextColumn::make('name')
                ->label('Nama')
                ->searchable()
                ->sortable(),

            TextColumn::make('price')
                ->label('Harga')
                ->money('IDR', locale: 'id_ID')
                ->sortable(),

            BadgeColumn::make('slug')
                ->label('Slug')
                ->color('gray'),

            TextColumn::make('stock')
            ->label('Stok')
            ->sortable(),

        ]);
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
