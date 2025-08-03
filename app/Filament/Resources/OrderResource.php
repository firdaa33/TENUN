<?php

namespace App\Filament\Resources;

use App\Filament\Resources\OrderResource\Pages;
use App\Models\Order;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\FileUpload;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Actions\Action;
use Filament\Notifications\Notification;

class OrderResource extends Resource
{
    protected static ?string $model = Order::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('invoice_number')->disabled(),
                TextInput::make('user_id')->disabled(),

                Select::make('status')
                    ->label('Status Pesanan')
                    ->options([
                        'menunggu pembayaran' => 'Menunggu Pembayaran',
                        'diproses' => 'Diproses',
                        'dikirim' => 'Dikirim',
                        'selesai' => 'Selesai',
                    ])
                    ->required(),

                FileUpload::make('payment_proof')
                    ->label('Bukti Pembayaran')
                    ->image()
                    ->directory('payment_proofs')
                    ->downloadable()
                    ->previewable()
                    ->openable()
                    ->columnSpan('full'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('invoice_number')->label('Invoice'),
                TextColumn::make('user.name')->label('Nama Pelanggan'),

                BadgeColumn::make('status')
                    ->label('Status')
                    ->colors([
                        'danger' => 'menunggu pembayaran',
                        'warning' => 'diproses',
                        'info' => 'dikirim',
                        'success' => 'selesai',
                    ]),

                TextColumn::make('payment_method')
                    ->label('Metode Pembayaran')
                    ->formatStateUsing(fn ($state) => $state === 'cod' ? 'COD (Bayar di Tempat)' : 'Transfer Bank'),

                ImageColumn::make('payment_proof')
                    ->label('Bukti Transfer')
                    ->size(100)
                    ->visible(fn ($record) => !empty($record?->payment_proof)),

                TextColumn::make('total_price')
                    ->label('Total')
                    ->money('IDR', locale: 'id')
                    ->sortable(),
            ])

            ->filters([
                SelectFilter::make('status')
                    ->options([
                        'menunggu pembayaran' => 'Menunggu Pembayaran',
                        'diproses' => 'Diproses',
                        'dikirim' => 'Dikirim',
                        'selesai' => 'Selesai',
                    ]),
            ])

            ->actions([
                Tables\Actions\EditAction::make(),

                Action::make('validasiPembayaran')
                    ->label('Validasi Pembayaran')
                    ->icon('heroicon-o-check-circle')
                    ->color('success')
                    ->visible(fn ($record) =>
                        $record->status === 'menunggu pembayaran'
                        && $record->payment_proof !== null
                        && $record->payment_method === 'transfer'
                    )
                    ->requiresConfirmation()
                    ->action(function ($record) {
                        $record->status = 'diproses';
                        $record->save();

                        Notification::make()
                            ->title('Pembayaran tervalidasi')
                            ->success()
                            ->send();
                    }),

                Action::make('konfirmasiSelesai')
                    ->label('Konfirmasi Selesai')
                    ->icon('heroicon-o-check-badge')
                    ->color('primary')
                    ->visible(fn ($record) => $record->status === 'dikirim')
                    ->requiresConfirmation()
                    ->action(function ($record) {
                        $record->status = 'selesai';
                        $record->save();

                        $record->user->notify(new \App\Notifications\OrderStatusUpdated($record));

                        Notification::make()
                            ->title('Pesanan dikonfirmasi selesai')
                            ->success()
                            ->send();
                    }),

                Action::make('cetakInvoice')
                    ->label('Cetak Invoice')
                    ->icon('heroicon-o-printer')
                    ->color('secondary')
                    ->url(fn ($record) => route('admin.invoice', ['order' => $record->id]))
                    ->openUrlInNewTab(),

                Action::make('downloadInvoice')
                    ->label('Download PDF')
                    ->icon('heroicon-o-arrow-down-tray')
                    ->color('secondary')
                    ->url(fn ($record) => route('admin.invoice.pdf', $record))
                    ->openUrlInNewTab(),
            ])

            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
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
