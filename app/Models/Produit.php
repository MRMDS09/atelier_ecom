<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Produit extends Model
{
    //
    use SoftDeletes;
    protected $primaryKey = 'idproduit';

    protected $table = 'produits';

    public $incrementing = true;

    protected $keyType = 'int';

    protected $fillable = [

        'categorie_id',
        'nom_produit',
        'slug',
        'description',
        'prix',
        'stock',
        'image',
        'status',

    ];


    protected $casts = [
        'status'=>'boolean',
        'prix'=>'decimal:2',
    ];



    public function categorie()
    {
        return $this->belongsTo(
            CategorieProd::class,
            'categorie_id'
        );
    }
    public function images()
    {
        return $this->hasMany(
            ProduitImage::class,
            'produit_id',
            'idproduit'
        );
    }

    public function getMainImagePathAttribute(): ?string
    {
        if ($this->relationLoaded('images')) {
            $image = $this->images->firstWhere('is_main', true) ?? $this->images->first();

            return $image?->image ?? $this->image;
        }

        $mainImage = $this->images()->where('is_main', true)->first();

        return ($mainImage ?? $this->images()->first())?->image ?? $this->image;
    }
    public function lignesCommande()
{
    return $this->hasMany(
        LigneCommande::class,
        'produit_id',
        'idproduit'
    );
}
}
