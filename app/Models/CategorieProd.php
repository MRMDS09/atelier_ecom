<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class CategorieProd extends Model
{
    use SoftDeletes;

    protected $table = 'categorie_prods';

    protected $primaryKey = 'id_categorie_prd';

    public $incrementing = true;

    protected $keyType = 'int';

    protected $fillable = [
        'slug',
        'nom_categorie',
        'description',
        'image',
        'status',
    ];

    protected $casts = [
        'status' => 'boolean',
    ];
    public function produits()
{
    return $this->hasMany(
        Produit::class,
        'categorie_id'
    );
}
}