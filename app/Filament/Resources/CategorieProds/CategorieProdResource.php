<?php

namespace App\Filament\Resources\CategorieProds;

use App\Filament\Resources\CategorieProds\Pages\CreateCategorieProd;
use App\Filament\Resources\CategorieProds\Pages\EditCategorieProd;
use App\Filament\Resources\CategorieProds\Pages\ListCategorieProds;
use App\Filament\Resources\CategorieProds\Pages\ViewCategorieProd;
use App\Filament\Resources\CategorieProds\Schemas\CategorieProdForm;
use App\Filament\Resources\CategorieProds\Schemas\CategorieProdInfolist;
use App\Filament\Resources\CategorieProds\Tables\CategorieProdsTable;
use App\Models\CategorieProd;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class CategorieProdResource extends Resource
{
    protected static ?string $model = CategorieProd::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'nom_categorie';

    public static function form(Schema $schema): Schema
    {
        return CategorieProdForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return CategorieProdInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return CategorieProdsTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListCategorieProds::route('/'),
            'create' => CreateCategorieProd::route('/create'),
            'view' => ViewCategorieProd::route('/{record}'),
            'edit' => EditCategorieProd::route('/{record}/edit'),
        ];
    }

    public static function getRecordRouteBindingEloquentQuery(): Builder
    {
        return parent::getRecordRouteBindingEloquentQuery()
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }
}
