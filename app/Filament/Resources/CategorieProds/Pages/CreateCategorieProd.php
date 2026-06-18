<?php

namespace App\Filament\Resources\CategorieProds\Pages;

use App\Filament\Resources\CategorieProds\CategorieProdResource;
use Filament\Resources\Pages\CreateRecord;

class CreateCategorieProd extends CreateRecord
{
    protected static string $resource = CategorieProdResource::class;
   protected function afterCreate(): void
     {

       $images = $this->data['images'] ?? [];


       foreach ($images as $index => $image)
       {

        ProduitImage::create([
            'produit_id'=>$this->record->id,
            'image'=>$image,
            'is_main'=>$index === 0,
        ]);

      }

    }
}
