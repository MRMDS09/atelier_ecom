<?php

namespace App\Filament\Resources\Commandes\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class CommandeForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('reference')
                    ->required(),
                TextInput::make('nom_client')
                    ->required(),
                TextInput::make('telephone')
                    ->tel()
                    ->default(null),
                TextInput::make('telephone_secondaire')
                    ->tel()
                    ->default(null),
                TextInput::make('email')
                    ->label('Email address')
                    ->email()
                    ->default(null),
                TextInput::make('adresse_livraison')
                    ->required(),
                TextInput::make('ville')
                    ->required(),
                TextInput::make('code_postal')
                    ->default(null),
                TextInput::make('pays')
                    ->required()
                    ->default('Maroc'),
                Select::make('status')
                    ->options([
            'en_attente' => 'En attente',
            'confirmee' => 'Confirmee',
            'expediee' => 'Expediee',
            'retouree' => 'Retouree',
            'livree' => 'Livree',
            'annulee' => 'Annulee',
        ])
                    ->default('en_attente')
                    ->required(),
                TextInput::make('sous_total')
                    ->required()
                    ->numeric()
                    ->default(0.0),
                TextInput::make('frais_livraison')
                    ->required()
                    ->numeric()
                    ->default(0.0),
                TextInput::make('total')
                    ->required()
                    ->numeric()
                    ->default(0.0),
                TextInput::make('payment_method')
                    ->default(null),
                Select::make('payment_status')
                    ->options([
            'en_attente' => 'En attente',
            'non_paye' => 'Non paye',
            'paye' => 'Paye',
            'rembourse' => 'Rembourse',
            'echec' => 'Echec',
        ])
                    ->default('non_paye')
                    ->required(),
                Textarea::make('notes')
                    ->default(null)
                    ->columnSpanFull(),
            ]);
    }
}
