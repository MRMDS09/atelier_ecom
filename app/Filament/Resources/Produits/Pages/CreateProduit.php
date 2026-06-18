<?php

namespace App\Filament\Resources\Produits\Pages;

use App\Filament\Resources\Produits\ProduitResource;
use Filament\Resources\Pages\CreateRecord;

class CreateProduit extends CreateRecord
{
    protected static string $resource = ProduitResource::class;

    protected function afterCreate(): void
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
