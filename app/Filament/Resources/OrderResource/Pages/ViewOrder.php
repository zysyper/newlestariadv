<?php

namespace App\Filament\Resources\OrderResource\Pages;

use App\Filament\Resources\OrderResource;
use Filament\Forms\Components\Placeholder;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\View;
use Filament\Forms\Form;
use Filament\Actions;
use Filament\Infolists;
use Filament\Infolists\Components\RepeatableEntry;
use Filament\Infolists\Components\Section as InfolistSection;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Infolist;
use Filament\Resources\Pages\ViewRecord;
use Filament\Support\Enums\Alignment;
use Filament\Support\Facades\FilamentView;
use Illuminate\Support\Number;
use App\Models\Order;
use App\Models\produk;
use App\Models\orderitem;
use App\Models\User;
use App\Models\kategori;

class ViewOrder extends ViewRecord
{
    protected static string $resource = OrderResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
            Actions\DeleteAction::make(),
        ];
    }

    public function getTitle(): string
    {
        return "Order #{$this->record->id}";
    }

    public function getSubheading(): ?string
    {
        return "Customer: {$this->record->user->name} | Date: {$this->record->created_at->format('d M Y H:i')}";
    }

    public function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                InfolistSection::make('Order Information')
                    ->schema([
                        TextEntry::make('user.name')
                            ->label('Customer'),
                        TextEntry::make('payment_method')
                            ->label('Jenis Pembayaran')
                            ->formatStateUsing(fn (string $state): string => match ($state) {
                                'qris' => 'Qris',
                                'cod' => 'Ambil Sendiri',
                                default => $state,
                            }),
                        TextEntry::make('payment_status')
                            ->label('Informasi Pembayaran')
                            ->badge()
                            ->color(fn (string $state): string => match ($state) {
                                'pending' => 'warning',
                                'paid' => 'success',
                                'failed' => 'danger',
                                default => 'gray',
                            }),
                        TextEntry::make('status')
                            ->label('Status Order')
                            ->badge()
                            ->color(fn (string $state): string => match ($state) {
                                'new' => 'info',
                                'processing' => 'warning',
                                'shinpped' => 'info',
                                'delivered' => 'success',
                                'canceled' => 'danger',
                                default => 'gray',
                            })
                            ->formatStateUsing(fn (string $state): string => match ($state) {
                                'new' => 'Baru',
                                'processing' => 'Proses',
                                'shinpped' => 'Dalam Perjalanan',
                                'delivered' => 'Diterima',
                                'canceled' => 'Batal',
                                default => $state,
                            }),
                        TextEntry::make('shipping_status')
                            ->label('Metode Pengiriman')
                            ->formatStateUsing(fn (string $state): string => match ($state) {
                                'jne' => 'JNE',
                                'jnt' => 'JNT',
                                'gosend' => 'Gosend',
                                'ambil' => 'Ambil Sendiri',
                                default => $state,
                            }),
                        TextEntry::make('notes')
                            ->label('Catatan')
                            ->columnSpanFull(),
                    ])
                    ->columns(2),

                InfolistSection::make('Order Items')
                    ->schema([
                        RepeatableEntry::make('items')
                            ->schema([
                                TextEntry::make('produk.name')
                                    ->label('Produk'),
                                TextEntry::make('quantity')
                                    ->label('Jumlah'),
                                TextEntry::make('unit_amount')
                                    ->label('Harga Satuan')
                                    ->money('IDR'),
                                TextEntry::make('total_amount')
                                    ->label('Total')
                                    ->money('IDR'),
                            ])
                            ->columns(4),

                        TextEntry::make('grand_total')
                            ->label('Total Harga')
                            ->money('IDR')
                            ->size(TextEntry\TextEntrySize::Large)
                            ->alignRight(),
                    ]),
            ]);
    }
}
