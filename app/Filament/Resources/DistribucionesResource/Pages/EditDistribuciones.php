<?php

namespace App\Filament\Resources\DistribucionesResource\Pages;

use App\Filament\Resources\DistribucionesResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditDistribuciones extends EditRecord
{
    protected static string $resource = DistribucionesResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
