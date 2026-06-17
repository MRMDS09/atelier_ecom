<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Commande extends Model
{
    //
    use SoftDeletes;
      protected $table = 'commandes';

    protected $primaryKey = 'id_commande';

    public $incrementing = true;

    protected $keyType = 'int';


    protected $fillable = [
        'reference',
        'nom_client',
        'telephone',
        'email',
        'total',
        'status',
        'adresse_livraison',
        'ville',
        'code_postal',
        'pays',
        'payment_method',
        'payment_status',
        'notes',
    ];


    protected $casts = [
        'total' => 'decimal:2',
    ];
   public function ligne_commandes()
    {
        return $this->hasMany(
            LigneCommande::class,
            'commande_id',
            'id_commande'
        );
    }
     public function produits()
    {
        return $this->belongsToMany(
            Produit::class,
            'lignes_commande',
            'commande_id',
            'produit_id',
            'id_commande',
            'idproduit'
        )
        ->withPivot([
            'quantite',
            'prix_unitaire'
        ]);
    }
}
