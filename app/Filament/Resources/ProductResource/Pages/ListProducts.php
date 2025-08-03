<?php

namespace App\Filament\Resources\ProductResource\Pages;

use App\Filament\Resources\ProductResource;
use Filament\Resources\Pages\ListRecords;
use Filament\Actions\CreateAction;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\ViewAction;
use Filament\Tables\Actions\BulkActionGroup;
use Filament\Tables\Actions\DeleteBulkAction;

class ListProducts extends ListRecords
{
    protected static string $resource = ProductResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make()
                ->label('Tambah Produk Baru')
                ->icon('heroicon-m-plus'),
        ];
    }

   protected function getTableActions(): array
{
    return [
        DeleteAction::make(),
    ];
}

    protected function getBulkActions(): array
    {
        return [
            BulkActionGroup::make([
                DeleteBulkAction::make(), // ✅ DELETE MULTIPLE RECORD
            ]),
        ];
    }
}
