<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class LigneCommande extends Model
{
    use SoftDeletes;
   
    protected $table = 'ligne_commandes';


    protected $primaryKey = 'id_ligne_commande';

    public $incrementing = true;

    protected $keyType = 'int';

    protected $fillable = [

        'commande_id',
        'produit_id',
        'quantite',
        'prix_unitaire',
        'total_ligne'

    ];



    public function commande()
    {
        return $this->belongsTo(
            Commande::class,
            'commande_id',
            'id_commande'
        );
    }



    public function produit()
    {
        return $this->belongsTo(
            Produit::class,
            'produit_id',
            'idproduit'
        );
    }
}
