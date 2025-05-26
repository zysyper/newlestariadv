<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProdukResource\Pages;
use App\Filament\Resources\ProdukResource\RelationManagers;
use App\Models\Produk;
use Filament\Forms;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Forms\Set;
use Filament\Resources\Resource;
use Illuminate\Support\Str;
use Filament\Tables;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ProdukResource extends Resource
{
    protected static ?string $model = Produk::class;

    protected static ?string $navigationIcon = 'heroicon-o-archive-box';

    protected static ?string $recordTitleAttribute = 'name';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Group::make()->schema([
                    Section::make('Informasi Produk')->schema([
                        TextInput::make('name')
                            ->required()
                            ->maxLength(255)
                            ->live(onBlur: true)
                            ->afterStateUpdated(function (string $operation, $state, Set $set){
                                if ($operation !== 'create'){
                                    return;
                                }
                                $set('slug', Str::slug($state));
                            }),
                        TextInput::make('slug')
                            ->required()
                            ->disabled()
                            ->dehydrated()
                            ->maxLength(255)
                            ->unique(produk::class , 'slug' , ignoreRecord: true),
                        MarkdownEditor::make('deskripsi')
                            ->columnSpanFull()
                            ->fileAttachmentsDirectory('produks')
                    ])->columns(2),
                    Section::make('images')->schema([
                        FileUpload::make('images')
                            ->image()
                            ->multiple()
                            ->directory('produk')
                            ->maxFiles(5),
                    ])
                ])->columnSpan(2),
                Group::make()->schema([
                    Section::make('harga')->schema([
                        TextInput::make('harga')
                            ->numeric()
                            ->required()
                            ->prefix('IDR')
                    ]),

                    Section::make('Kategori')->schema([
                        Select::make('kategori_id')
                            ->searchable()
                            ->required()
                            ->preload()
                            ->relationship('kategori', 'name')
                    ]),

                    Section::make('Status')->schema([
                        Toggle::make('in_stock')
                        ->required()
                        ->default(true),
                        Toggle::make('is_active')
                        ->required()
                        ->default(true),
                        Toggle::make('is_featured')
                        ->label('Favorite')
                        ->required()
                        ->default(false),
                        Toggle::make('on_sale')
                        ->required()
                        ->default(true),
                    ])

                ])->columnSpan(1),
            ])->columns(3);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                ->searchable(),
                TextColumn::make('kategori.name')
                ->searchable(),
                ImageColumn::make('images'),
                TextColumn::make('harga')
                ->money('IDR')
                ->sortable(),
                IconColumn::make('in_stock')
                ->boolean()
                ->toggleable(isToggledHiddenByDefault: true),
                IconColumn::make('on_sale')
                ->boolean()
                ->toggleable(isToggledHiddenByDefault: true),
                IconColumn::make('is_featured')
                ->boolean()
                ->toggleable(isToggledHiddenByDefault: true),
                IconColumn::make('is_active')
                ->boolean()
                ->toggleable(isToggledHiddenByDefault: true),




            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ActionGroup::make([
                    Tables\Actions\DeleteAction::make(),
                    Tables\Actions\ViewAction::make(),
                    Tables\Actions\EditAction::make(),
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
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListProduks::route('/'),
            'create' => Pages\CreateProduk::route('/create'),
            'edit' => Pages\EditProduk::route('/{record}/edit'),
        ];
    }
}
