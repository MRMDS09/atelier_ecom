<?php

namespace App\Filament\Resources\Commandes\Schemas;

use App\Models\Commande;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class CommandeInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('reference'),
                TextEntry::make('nom_client'),
                TextEntry::make('telephone')
                    ->placeholder('-'),
                TextEntry::make('telephone_secondaire')
                    ->placeholder('-'),
                TextEntry::make('email')
                    ->label('Email address')
                    ->placeholder('-'),
                TextEntry::make('adresse_livraison'),
                TextEntry::make('ville'),
                TextEntry::make('code_postal')
                    ->placeholder('-'),
                TextEntry::make('pays'),
                TextEntry::make('status')
                    ->badge(),
                TextEntry::make('sous_total')
                    ->numeric(),
                TextEntry::make('frais_livraison')
                    ->numeric(),
                TextEntry::make('total')
                    ->numeric(),
                TextEntry::make('payment_method')
                    ->placeholder('-'),
                TextEntry::make('payment_status')
                    ->badge(),
                TextEntry::make('notes')
                    ->placeholder('-')
                    ->columnSpanFull(),
                TextEntry::make('deleted_at')
                    ->dateTime()
                    ->visible(fn (Commande $record): bool => $record->trashed()),
                TextEntry::make('created_at')
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('updated_at')
                    ->dateTime()
                    ->placeholder('-'),
            ]);
    }
}
