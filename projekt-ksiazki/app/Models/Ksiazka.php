<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ksiazka extends Model
{
    use HasFactory;
    
    protected $table = 'ksiazki';
    protected $fillable = ['tytul', 'autor', 'kategoria_id'];
    
    public $timestamps = true; 
    
    const CREATED_AT = 'utworzono'; 
    const UPDATED_AT = 'zaktualizowano'; 
    
    public function kategoria()
    {
        return $this->belongsTo(Kategoria::class, 'kategoria_id');
    }
}
