<?php

namespace App\Filament\Resources\Produits\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Component;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Schemas\Schema;
use Illuminate\Support\Arr;

class ProduitForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('categorie_id')
                    ->label('Categorie')
                    ->relationship(
                        'categorie',
                        'nom_categorie'
                    )
                    ->required(),

                TextInput::make('nom_produit')
                    ->required(),

                TextInput::make('slug')
                    ->required()
                    ->unique(ignoreRecord: true),

                Textarea::make('description')
                    ->default(null)
                    ->columnSpanFull(),

                TextInput::make('prix')
                    ->required()
                    ->numeric(),

                Repeater::make('images')
                    ->relationship()
                    ->minItems(1)
                    ->defaultItems(1)
                    ->addActionLabel('Add image')
                    ->mutateRelationshipDataBeforeCreateUsing(
                        fn (array $data): ?array => filled($data['image'] ?? null) ? $data : null,
                    )
                    ->mutateRelationshipDataBeforeSaveUsing(
                        fn (array $data): ?array => filled($data['image'] ?? null) ? $data : null,
                    )
                    ->schema([
                        FileUpload::make('image')
                            ->label('Image')
                            ->image()
                            ->required()
                            ->disk('public')
                            ->directory('produits')
                            ->getUploadedFileNameForStorageUsing(function ($file, $get) {
                                $slug = $get('../../slug') ?: 'produit';

                                return $slug . '-' . time() . '-' . uniqid() . '.' . $file->getClientOriginalExtension();
                            }),

                        Toggle::make('is_main')
                            ->label('Image principale')
                            ->live()
                            ->afterStateUpdated(function (Component $component, ?bool $state, Set $set): void {
                                if (! $state) {
                                    return;
                                }

                                $repeater = $component->getParentRepeater();

                                if (! $repeater) {
                                    return;
                                }

                                $repeaterStatePath = $repeater->getStatePath();
                                $componentStatePath = (string) str($component->getStatePath())
                                    ->after("{$repeaterStatePath}.")
                                    ->after('.');
                                $itemKey = (string) str($component->getStatePath())
                                    ->after("{$repeaterStatePath}.")
                                    ->beforeLast(".{$componentStatePath}");

                                foreach (Arr::except($repeater->getRawState(), [$itemKey]) as $siblingKey => $itemState) {
                                    if (data_get($itemState, $componentStatePath)) {
                                        $set("{$repeaterStatePath}.{$siblingKey}.{$componentStatePath}", false, true);
                                    }
                                }
                            }),
                    ]),

                Toggle::make('status')
                    ->required(),

                TextInput::make('stock')
                    ->required()
                    ->numeric()
                    ->default(0),
            ]);
    }
}
