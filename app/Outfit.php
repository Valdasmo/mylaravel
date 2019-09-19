<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Outfit extends Model
{
    public function outfitMaster()
    {
        return $this->belongsTo('App\Master', 'author_id', 'id');
    }
 
}
