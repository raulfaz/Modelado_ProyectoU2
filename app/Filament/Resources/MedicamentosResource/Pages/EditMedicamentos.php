<?php

namespace App\Filament\Resources\MedicamentosResource\Pages;

use App\Filament\Resources\MedicamentosResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditMedicamentos extends EditRecord
{
    protected static string $resource = MedicamentosResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
