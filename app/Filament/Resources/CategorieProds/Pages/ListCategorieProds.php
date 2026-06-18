<?php

namespace App\Filament\Resources\CategorieProds\Pages;

use App\Filament\Resources\CategorieProds\CategorieProdResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListCategorieProds extends ListRecords
{
    protected static string $resource = CategorieProdResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
