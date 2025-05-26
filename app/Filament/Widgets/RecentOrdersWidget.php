<?php

namespace App\Filament\Widgets;

use App\Filament\Resources\OrderResource;
use App\Models\Order;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;
use Illuminate\Support\Number;

class RecentOrdersWidget extends BaseWidget
{
    protected int | string | array $columnSpan = 'full';

    protected static ?int $sort = 2;

    public function table(Table $table): Table
    {
        return $table
            ->query(
                Order::query()->latest()->limit(10)
            )
            ->columns([
                Tables\Columns\TextColumn::make('id')
                    ->label('Order ID')
                    ->badge()
                    ->color('primary'),

                Tables\Columns\TextColumn::make('user.name')
                    ->label('Customer')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('grand_total')
                    ->label('Total')
                    ->formatStateUsing(fn ($state) => Number::currency($state, 'IDR'))
                    ->sortable(),

                Tables\Columns\BadgeColumn::make('payment_method')
                    ->label('Pembayaran')
                    ->colors([
                        'primary' => 'qris',
                        'secondary' => 'cod',
                    ]),

                Tables\Columns\SelectColumn::make('payment_status')
                    ->label('Status Bayar')
                    ->options([
                            'pending' => 'Pending',
                            'paid' => 'Paid',
                            'failed' => 'Failed'
                        ]),

                Tables\Columns\SelectColumn::make('status')
                    ->label('Status Order')
                    ->options([
                    'new' => 'Baru',
                    'processing' => 'Proses',
                    'shinpped' => "Dalam Perjalanan",
                    'delivered' => 'Diterima',
                    'canceled' => 'Batal'
                ]),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Tanggal')
                    ->dateTime('d/m/Y H:i')
                    ->sortable(),
            ])
            ->actions([
                Tables\Actions\Action::make('view')
                    ->label('Lihat')
                    ->icon('heroicon-m-eye')
                    ->url(fn (Order $record): string => OrderResource::getUrl('view', ['record' => $record]))
                    ->openUrlInNewTab(),
            ])
            ->heading('Pesanan Terbaru')
            ->description('10 pesanan terakhir yang masuk')
            ->emptyStateHeading('Belum ada pesanan')
            ->emptyStateDescription('Pesanan akan muncul di sini setelah ada yang masuk.')
            ->emptyStateIcon('heroicon-o-shopping-bag');
    }
}
