<?php

namespace App\Filament\Resources\MedicamentosResource\Pages;

use App\Filament\Resources\MedicamentosResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListMedicamentos extends ListRecords
{
    protected static string $resource = MedicamentosResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
