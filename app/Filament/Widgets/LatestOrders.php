<?php

namespace App\Filament\Widgets;

use App\Filament\Resources\OrderResource;
use App\Models\Order;
use Filament\Tables;
use Filament\Tables\Actions\Action;
use Filament\Tables\Columns\SelectColumn;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;

class LatestOrders extends BaseWidget
{
    protected int|string|array $columnSpan = 'full';
    protected static ?int $sort = 2;

    public function table(Table $table): Table
    {
        return $table
            ->query(OrderResource::getEloquentQuery())
            ->defaultPaginationPageOption(5)
            ->defaultSort('created_at','DESC')
            ->columns([
                Tables\Columns\TextColumn::make('id')
                ->label('Order ID')
                ->searchable()
                ->toggleable(isToggledHiddenByDefault: true),

                Tables\Columns\TextColumn::make('user.name')
                ->label('Customer')
                ->searchable(),

                Tables\Columns\TextColumn::make('grand_total')
                ->label('Grand Total')
                ->money('IDR'),

                Tables\Columns\TextColumn::make('status')
                ->label('Status')
                ->badge()
                ->color(fn(string $state): string => match ($state) {
                    'new'   => 'info',
                    'processing' => 'primary',
                    'shipped' => 'success',
                    'delivered' => 'success',
                    'canceled' =>'danger',
                })
                ->searchable()
                ->icon(fn(string $state): string => match ($state) {
                    'new'   => 'heroicon-m-sparkles',
                    'processing' => 'heroicon-m-arrow-path',
                    'shipped' => 'heroicon-m-truck',
                    'delivered' => 'heroicon-m-check',
                    'canceled' => 'heroicon-m-x-circle',
                })
                ->sortable(),

                Tables\Columns\TextColumn::make('payment_method')
                ->label('Payment Method')
                ->searchable()
                ->sortable(),

                Tables\Columns\TextColumn::make('payment_status')
                ->label('Payment Status')
                ->searchable()
                ->badge()
                ->color(fn(string $state): string => match ($state) {
                    'pending'   => 'primary',
                    'paid' => 'success',
                    'failed' => 'danger',
                })
                ->sortable(),

                Tables\Columns\TextColumn::make('created_at')
                ->label('Order Date')
                ->dateTime(),
            ])
            ->actions([
                Action::make('View Order')
                    ->url(fn(Order $record): string => OrderResource::getUrl('view',['record' => $record]))
                    ->color('info')
                    ->icon('heroicon-o-eye'),
            ]);
    }
}
