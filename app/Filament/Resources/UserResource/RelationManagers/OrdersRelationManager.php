<?php

namespace App\Filament\Resources\UserResource\RelationManagers;

use App\Filament\Resources\OrderResource;
use App\Models\Order;
use Filament\Forms;
use Filament\Forms\Components\Tabs\Tab;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Actions\Action;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class OrdersRelationManager extends RelationManager
{
    protected static string $relationship = 'orders';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
               
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('id')
            ->columns([
                Tables\Columns\TextColumn::make('id')
                ->label('Order ID')
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
            ->filters([
                //
            ])
            ->headerActions([
                // Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Action::make('View Order')
                    ->url(fn(Order $record): string => OrderResource::getUrl('view',['record' => $record]))
                    ->color('info')
                    ->icon('heroicon-o-eye'),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}
