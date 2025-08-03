<?php

namespace App\Filament\Resources;

use App\Filament\Resources\RatingResource\Pages;
use App\Models\Rating;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\Select;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Filters\Filter;
use Illuminate\Database\Eloquent\Builder;

class RatingResource extends Resource
{
    protected static ?string $model = Rating::class;

    protected static ?string $navigationIcon = 'heroicon-o-star';
    protected static ?string $navigationLabel = 'Rating Produk';
    protected static ?string $pluralModelLabel = 'Rating';
    protected static ?string $navigationGroup = 'Manajemen Produk';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('user_id')
                    ->relationship('user', 'name')
                    ->label('User')
                    ->disabled(),

                Select::make('product_id')
                    ->relationship('product', 'name')
                    ->label('Produk')
                    ->disabled(),

                TextInput::make('rating')
                    ->numeric()
                    ->label('Rating')
                    ->disabled(),

                Textarea::make('comment')
                    ->label('Komentar')
                    ->disabled()
                    ->rows(4),

                Toggle::make('is_approved')
                    ->label('Disetujui?'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('user.name')->label('User'),
                TextColumn::make('product.name')->label('Produk'),
                TextColumn::make('rating')->label('Rating'),
                TextColumn::make('comment')->limit(30)->label('Komentar'),
                IconColumn::make('is_approved')
                    ->label('Disetujui')
                    ->boolean(),
                TextColumn::make('created_at')
                    ->label('Tanggal')
                    ->dateTime('d M Y'),
            ])
            ->filters([
                Filter::make('Belum Disetujui')
                    ->query(fn (Builder $query) => $query->where('is_approved', false)),
                Filter::make('Sudah Disetujui')
                    ->query(fn (Builder $query) => $query->where('is_approved', true)),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListRatings::route('/'),
            'edit' => Pages\EditRating::route('/{record}/edit'),
        ];
    }
}
