<?php

namespace App\Filament\Resources;

use App\Filament\Resources\OrderResource\Pages;
use App\Filament\Resources\OrderResource\RelationManagers;
use App\Filament\Resources\OrderResource\RelationManagers\AddressRelationManager;
use Filament\Forms\Components\Hidden;
use App\Models\Order;
use App\Models\produk;
use Filament\Forms;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\Placeholder;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\ToggleButtons;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Forms\Set;
use Filament\Resources\Resource;
use Filament\Support\Facades\FilamentNumber;
use Illuminate\Support\Number;
use Filament\Tables;
use Filament\Tables\Columns\Column;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\Relationship;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Support\Enums\Currency;
use Filament\Support\Facades\FilamentView;
use Filament\Support\Formatting\NumberFormatter;
use Filament\Forms\Components\FileUpload;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Support\Facades\Storage;

class OrderResource extends Resource
{
    protected static ?string $model = Order::class;

    protected static ?string $navigationIcon = 'heroicon-o-shopping-bag';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Group::make()->schema([
                    Section::make('order informasi')->schema([
                        Select::make('user_id')
                        ->label('Customer')
                        ->relationship('user', 'name')
                        ->searchable()
                        ->preload()
                        ->required(),

                        Select::make('payment_method')
                        ->label('jenis pembayaran')
                        ->options([
                            'qris' => 'Qris',
                            'cod' => 'Ambil Sendiri'
                        ])
                        ->required(),

                        Select::make('payment_status')
                        ->label('Informasi Pembayaran')
                        ->options([
                            'pending' => 'Pending',
                            'paid' => 'Paid',
                            'failed' => 'Failed'
                        ])
                        ->default('pending')
                        ->required(),

                        TextInput::make('phone')
                            ->required()
                            ->maxLength(255),

                        ToggleButtons::make('status')
                        ->inline()
                        ->options([
                            'new' => 'Baru',
                            'processing' => 'Proses',
                            'shipped' => "Dalam Perjalanan",
                            'delivered' => 'Diterima',
                            'canceled' => 'Batal'
                        ])
                        ->required()
                        ->default('new')
                        ->colors([
                            'new' => 'info',
                            'processing' => 'warning',
                            'shipped' => "info",
                            'delivered' => 'success',
                            'canceled' => 'danger'
                        ]),

                        FileUpload::make('file_path')
                        ->disk('public')
                        ->directory('uploads/dokumen')
                        ->preserveFilenames()
                        ->downloadable()
                        ->previewable(false)
                        ->openable(),

                        Textarea::make('notes'),
                        Textarea::make('catatan')
                    ])->columnSpanFull(),
                    Section::make('Order Item')->schema([
                        Repeater::make('items')
                        ->relationship()
                        ->schema([
                            Select::make('produk_id')
                            ->relationship('produk','name')
                            ->searchable()
                            ->preload()
                            ->required()
                            ->distinct()
                            ->disableOptionsWhenSelectedInSiblingRepeaterItems()
                            ->reactive()
                            ->afterStateUpdated(function ($state, Set $set) {
                                if ($state) {
                                    $product = produk::find($state);
                                    $price = $product ? $product->harga : 0;
                                    $set('unit_amount', $price);
                                    $set('total_amount', $price);
                                }
                            }),

                            TextInput::make('quantity')
                            ->numeric()
                            ->required()
                            ->default(1)
                            ->minValue(1)
                            ->reactive()
                            ->afterStateUpdated(function ($state, Set $set, Get $get) {
                                $unitAmount = floatval($get('unit_amount')) ?: 0;
                                $quantity = floatval($state) ?: 1;
                                $set('total_amount', $unitAmount * $quantity);
                            }),

                            TextInput::make('unit_amount')
                            ->label('Harga Satuan')
                            ->disabled()
                            ->dehydrated()
                            ->numeric()
                            ->required()
                            ->formatStateUsing(fn ($state) => $state ? round($state, 2) : 0)
                            ->afterStateUpdated(function ($state, Set $set, Get $get) {
                                $unitAmount = floatval($state) ?: 0;
                                $quantity = floatval($get('quantity')) ?: 1;
                                $set('total_amount', $unitAmount * $quantity);
                            }),

                            TextInput::make('total_amount')
                            ->label('Total')
                            ->disabled()
                            ->dehydrated()
                            ->numeric()
                            ->required()
                            ->formatStateUsing(fn ($state) => $state ? round($state, 2) : 0),
                        ])->columns(4),
                        Placeholder::make('grand_total_placeholder')
                        ->label('Total Harga')
                        ->content(function(Get $get, Set $set) {
                            $total = 0;
                            if (!$repeaters = $get('items')){
                                return $total;
                            }

                            foreach ($repeaters as $key => $repeater){
                                $total += floatval($get("items.$key.total_amount") ?: 0);
                            }
                            $set('grand_total', $total);

                            return Number::currency($total, 'IDR');
                        }),
                    ]),
                    Hidden::make('grand_total')
                        ->default(0)
                ])->columnSpanFull()
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')
                ->label('Order ID')
                ->sortable()
                ->searchable(),
                Tables\Columns\TextColumn::make('user.name')
                ->label('Customer')
                ->sortable()
                ->searchable(),
             Tables\Columns\TextColumn::make('grand_total')
                ->label('Total')
                ->money('IDR')
                ->sortable(),
            Tables\Columns\TextColumn::make('payment_method')
                ->label('Metode Pembayaran')
                ->sortable(),
            Tables\Columns\SelectColumn::make('payment_status')
                ->label('Status Pembayaran')
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
                ])
                ->sortable(),
                TextColumn::make('file_path')
                ->label('Download')
                ->url(fn ($record) => Storage::disk('public')->url($record->file_path))
                ->openUrlInNewTab()
                ->formatStateUsing(fn () => 'Unduh File'),
            Tables\Columns\TextColumn::make('created_at')
                ->label('Order Date')
                ->dateTime()
                ->sortable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ActionGroup::make([
                    Tables\Actions\ViewAction::make(),
                    Tables\Actions\EditAction::make(),
                    Tables\Actions\DeleteAction::make()
                ]),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [

        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListOrders::route('/'),
            'create' => Pages\CreateOrder::route('/create'),
            'view' => Pages\ViewOrder::route('/{record}'),
            'edit' => Pages\EditOrder::route('/{record}/edit'),
        ];
    }
}
