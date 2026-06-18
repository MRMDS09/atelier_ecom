<?php

namespace App\Filament\Resources\Produits\Pages;

use App\Filament\Resources\Produits\ProduitResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ForceDeleteAction;
use Filament\Actions\RestoreAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditProduit extends EditRecord
{
    protected static string $resource = ProduitResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
            ForceDeleteAction::make(),
            RestoreAction::make(),
        ];
    }

    protected function afterSave(): void
    {
        $this->keepOnlyOneMainImage();
    }

    private function keepOnlyOneMainImage(): void
    {
        $mainImageIds = $this->getRecord()
            ->images()
            ->where('is_main', true)
            ->orderBy('id_produit_image')
            ->pluck('id_produit_image');

        if ($mainImageIds->count() <= 1) {
            return;
        }

        $this->getRecord()
            ->images()
            ->whereIn('id_produit_image', $mainImageIds->skip(1))
            ->update(['is_main' => false]);
    }
}
