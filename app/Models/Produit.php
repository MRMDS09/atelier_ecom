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
        return $this->hasMany(ProduitImage::class);
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
