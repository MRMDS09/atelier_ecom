<?php

namespace App\Filament\Resources\CategorieProds\Pages;

use App\Filament\Resources\CategorieProds\CategorieProdResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewCategorieProd extends ViewRecord
{
    protected static string $resource = CategorieProdResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
