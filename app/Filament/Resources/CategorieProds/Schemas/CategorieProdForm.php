<?php

namespace App\Filament\Resources\CategorieProds\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class CategorieProdForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                 TextInput::make('nom_categorie')
                    ->label('Nom catégorie')
                    ->required(),
                    
                   TextInput::make('slug')
                    ->required()
                    ->unique(ignoreRecord: true),
               
                Textarea::make('description')
                    ->default(null)
                    ->columnSpanFull(),
                // pour renomer le fichier uploadé en utilisant le slug de la catégorie et un timestamp pour éviter les conflits de noms
               FileUpload::make('image')
                          ->image()
                   ->disk('public')
                    ->directory('categories')
                    ->getUploadedFileNameForStorageUsing(function ($file, $get) {
                     $slug = $get('slug');
                    return $slug . '-' . time() . '.' . $file->getClientOriginalExtension();
                     }),

                Toggle::make('status')
                    ->required(),
            ]);
    }
}
