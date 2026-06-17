<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProduitImage extends Model
{
    //
    use SoftDeletes;
     protected $primaryKey = 'id_produit_image';

    protected $table = 'produit_images';

    public $incrementing = true;

    protected $keyType = 'int';
     protected $fillable = [
        'produit_id',
        'image',
        'is_main'
    ];
    
    public function product()
    {
        return $this->belongsTo(Produit::class);
    }
}
