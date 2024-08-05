<?php

namespace App\Filament\Resources\DistribucionesResource\Pages;

use App\Filament\Resources\DistribucionesResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListDistribuciones extends ListRecords
{
    protected static string $resource = DistribucionesResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
