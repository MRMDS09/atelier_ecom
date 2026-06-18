<?php

namespace App\Filament\Resources\CategorieProds\Pages;

use App\Filament\Resources\CategorieProds\CategorieProdResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ForceDeleteAction;
use Filament\Actions\RestoreAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditCategorieProd extends EditRecord
{
    protected static string $resource = CategorieProdResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
            ForceDeleteAction::make(),
            RestoreAction::make(),
        ];
    }
}
