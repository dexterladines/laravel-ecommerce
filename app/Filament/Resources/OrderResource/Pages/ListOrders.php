<?php

namespace App\Filament\Resources\OrderResource\Pages;

use App\Filament\Resources\OrderResource;
use App\Filament\Resources\OrderResource\Widgets\OrderStats;
use App\Models\Order;
use Filament\Actions;
use Filament\Forms\Components\Tab;
use Filament\Resources\Components\Tab as ComponentsTab;
use Filament\Resources\Pages\ListRecords;

class ListOrders extends ListRecords
{
    protected static string $resource = OrderResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

    protected function getHeaderWidgets(): array
    {
        return [
            OrderStats::class
        ];
    }

    public function getTabs(): array
    {
      return [
        null => ComponentsTab::make('All'),
        'new' => ComponentsTab::make()->query(fn ($query) => $query->where('status', 'new')),
        'processing' => ComponentsTab::make()->query(fn ($query) => $query->where('status', 'processing')),
        'shipped' => ComponentsTab::make()->query(fn ($query) => $query->where('status', 'shipped')),
        'delivered' => ComponentsTab::make()->query(fn ($query) => $query->where('status', 'delivered')),
        'cancelled' => ComponentsTab::make()->query(fn ($query) => $query->where('status', 'cancelled'))
      ];
    }
}
